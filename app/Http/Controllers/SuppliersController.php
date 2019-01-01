<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Session;
use App\Supplier;

class SuppliersController extends Controller
{
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
        $suppliers = Supplier::all();
        Session::put('requestReferrer', URL::current());
        return view('suppliers.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
            'supplier_NAME' => 'required',
            'supplier_ADDRESS' => 'nullable',
            'supplier_PHONE' => 'nullable',
            'supplier_EMAIL' => 'email|nullable',
            'supplier_URL' => 'url|nullable',
            'supplier_DESCRIPTION' => 'nullable',
            'supplier_REP_NAME' => 'nullable',
            'supplier_REP_PHONE' => 'nullable',
            'supplier_REP_EMAIL' => 'email|nullable',
            'supplier_LOGO' => 'image|nullable|max:1999'
        ]);

        //File Upload
        if($request->hasFile('supplier_LOGO')){
            // Get file name extension
            $filenameWithExt = $request->file('supplier_LOGO')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extenstion = $request->file('supplier_LOGO')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extenstion;
            // Upload image
            $path = $request->file('supplier_LOGO')->storeAs('public/supplier_LOGO', $fileNameToStore);
        } else {
            $fileNameToStore = 'nologo.jpg';
        }

        $supplier = new Supplier;
        $supplier->supplier_NAME = $request->input('supplier_NAME');
        $supplier->supplier_ADDRESS = $request->input('supplier_ADDRESS');
        $supplier->supplier_PHONE = $request->input('supplier_PHONE');
        $supplier->supplier_EMAIL = $request->input('supplier_EMAIL');
        $supplier->supplier_URL = $request->input('supplier_URL');
        $supplier->supplier_DESCRIPTION = $request->input('supplier_DESCRIPTION');
        $supplier->supplier_REP_NAME = $request->input('supplier_REP_NAME');
        $supplier->supplier_REP_PHONE = $request->input('supplier_REP_PHONE');
        $supplier->supplier_REP_EMAIL = $request->input('supplier_REP_EMAIL');
        $supplier->supplier_CREATOR_ID = auth()->user()->id;
        $supplier->supplier_EDITOR_ID = auth()->user()->id;
        $supplier->supplier_LOGO = $fileNameToStore;
        $supplier->save();

        //return redirect('/suppliers')->with('success', 'Dodano nowego dostawcę');
        return redirect(Session::get('requestReferrer'))->with('success', 'Dodano nowego dostawcę: <b>'.$request->input('supplier_NAME').'</b>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.show')->with('supplier', $supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.edit')->with('supplier', $supplier);
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
            'supplier_NAME' => 'required',
            'supplier_ADDRESS' => 'nullable',
            'supplier_PHONE' => 'nullable',
            'supplier_EMAIL' => 'email|nullable',
            'supplier_URL' => 'url|nullable',
            'supplier_DESCRIPTION' => 'nullable',
            'supplier_REP_NAME' => 'nullable',
            'supplier_REP_PHONE' => 'nullable',
            'supplier_REP_EMAIL' => 'email|nullable',
            'supplier_LOGO' => 'image|nullable|max:1999'
        ]);

        //File Upload
        if($request->hasFile('supplier_LOGO')){
            // Get file name extension
            $filenameWithExt = $request->file('supplier_LOGO')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extenstion = $request->file('supplier_LOGO')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extenstion;
            // Upload image
            $path = $request->file('supplier_LOGO')->storeAs('public/supplier_LOGO', $fileNameToStore);
        }

        $supplier = Supplier::find($id);
        $supplier->supplier_NAME = $request->input('supplier_NAME');
        $supplier->supplier_ADDRESS = $request->input('supplier_ADDRESS');
        $supplier->supplier_PHONE = $request->input('supplier_PHONE');
        $supplier->supplier_EMAIL = $request->input('supplier_EMAIL');
        $supplier->supplier_URL = $request->input('supplier_URL');
        $supplier->supplier_DESCRIPTION = $request->input('supplier_DESCRIPTION');
        $supplier->supplier_REP_NAME = $request->input('supplier_REP_NAME');
        $supplier->supplier_REP_PHONE = $request->input('supplier_REP_PHONE');
        $supplier->supplier_REP_EMAIL = $request->input('supplier_REP_EMAIL');
        $supplier->supplier_EDITOR_ID = auth()->user()->id;
        if($request->hasFile('supplier_LOGO')){
            $supplier->supplier_LOGO = $fileNameToStore;
        }
        $supplier->save();

        //return redirect('/suppliers')->with('success', 'Dodano nowego dostawcę');
        //return redirect()->route('suppliers.show', $supplier->supplier_ID)->with('success', 'Zaktualizowano dostawcę');
        return redirect(Session::get('requestReferrer'))->with('success', 'Zaktualizowano dostawcę: <b>'.$request->input('supplier_NAME').'</b>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        //if(auth()->user()->id !==$supplier->supplier_CREATOR_ID){
        //    return redirect('/suppliers')->with('error', 'Tylko autor może usunąć dostawcę');
        //}

        if ($supplier->supplier_LOGO != 'nologo.jpg'){
            // Delete Image
            Storage::delete('public/supplier_LOGO/'.$supplier->supplier_LOGO);
        }
        $supplier->delete();
        //return redirect('/suppliers')->with('success', 'Usunięto dostawcę');
        return redirect(Session::get('requestReferrer'))->with('success', 'Usunięto dostawcę: <b>'.$supplier->supplier_NAME.'</b>');
    }
}
