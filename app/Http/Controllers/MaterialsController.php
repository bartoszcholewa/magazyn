<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;
use App\Material;
use App\Supplier;
use Facades\App\Repositories\MaterialsRepository;

class MaterialsController extends Controller
{
    var $materialRepository;
    /**
     * Autoryzacja dostępu
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* eager loading */
        $materials = Material::with('supplier')->get();

        /* cache */
        //$materials = MaterialsRepository::all('material_NAME');

        Session::put('requestReferrer', URL::current());
        return view('materials.index')->with('materials', $materials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all()->pluck('supplier_NAME', 'supplier_ID')->toArray();;
        return view('materials.create')->with('suppliers', $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'material_NAME' => 'required',
            'material_SUPPLIER' => 'required',
            'material_WIDTH' => 'required',
            'material_LENGTH' => 'required',
            'material_GSQM' => 'required',
            'material_DESCRIPTION' => 'nullable',
            'material_URL' => 'nullable',
        ]);
        $material = new Material;
        $material->material_NAME = $request->input('material_NAME');
        $material->material_SUPPLIER = $request->input('material_SUPPLIER');
        $material->material_WIDTH = $request->input('material_WIDTH');
        $material->material_LENGTH = $request->input('material_LENGTH');
        $material->material_GSQM = $request->input('material_GSQM');
        $material->material_DESCRIPTION = $request->input('material_DESCRIPTION');
        $material->material_URL = $request->input('material_URL');
        $material->material_CREATOR_ID = auth()->user()->id;
        $material->material_EDITOR_ID = auth()->user()->id;
        $material->save();

        $redirect_respond = "Dodano <a href='materials/".$material->material_ID."'>".$material->material_NAME."</a>";
        Controller::operation($redirect_respond);

        /* cache flush all */
        //MaterialsRepository::flush();

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /* cache */
        //$material = MaterialsRepository::get($id);

        $material = Material::with(['supplier', 'creator', 'editor'])->find($id);

        if(isset($material))
        {
            return view('materials.show')->with('material', $material);
        }
        else {
            return redirect(Session::get('requestReferrer'))->with('error', 'Ten materiał został usunięty.');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::find($id);
        $suppliers = Supplier::all()->pluck('supplier_NAME', 'supplier_ID')->toArray();
        return view('materials.edit', compact('material', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'material_NAME' => 'required',
            'material_SUPPLIER' => 'required',
            'material_WIDTH' => 'required',
            'material_LENGTH' => 'required',
            'material_GSQM' => 'required',
            'material_DESCRIPTION' => 'nullable',
            'material_URL' => 'nullable',
        ]);
        $material = Material::find($id);
        $material->material_NAME = $request->input('material_NAME');
        $material->material_SUPPLIER = $request->input('material_SUPPLIER');
        $material->material_WIDTH = $request->input('material_WIDTH');
        $material->material_LENGTH = $request->input('material_LENGTH');
        $material->material_GSQM = $request->input('material_GSQM');
        $material->material_DESCRIPTION = $request->input('material_DESCRIPTION');
        $material->material_URL = $request->input('material_URL');
        $material->material_EDITOR_ID = auth()->user()->id;
        $material->save();

        $redirect_respond = "Zaktualizowano <a href='materials/".$material->material_ID."'>".$material->material_NAME."</a>";
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::find($id);
        $material->delete();

        $redirect_respond = "Usunięto ".$material->material_NAME."";
        Controller::operation($redirect_respond);

        /* cache flush all */
        MaterialsRepository::flush();

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }

    public function raport($id)
    {
        $material = Material::find($id);
        Session::put('requestReferrer', URL::current());
        return view('materials.raport')->with('material', $material);
        
    }
}
