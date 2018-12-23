<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::all();
        return view('materials.index')->with('materials', $materials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materials.create');
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
        ]);
        $material = new Material;
        $material->material_NAME = $request->input('material_NAME');
        $material->material_SUPPLIER = $request->input('material_SUPPLIER');
        $material->material_WIDTH = $request->input('material_WIDTH');
        $material->material_LENGTH = $request->input('material_LENGTH');
        $material->material_GSQM = $request->input('material_GSQM');
        $material->save();

        return redirect('/materials')->with('success', 'Dodano nowy materiał');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        return view('materials.show')->with('material', $material);
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
        return view('materials.edit')->with('material', $material);
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
        ]);
        $material = Material::find($id);
        $material->material_NAME = $request->input('material_NAME');
        $material->material_SUPPLIER = $request->input('material_SUPPLIER');
        $material->material_WIDTH = $request->input('material_WIDTH');
        $material->material_LENGTH = $request->input('material_LENGTH');
        $material->material_GSQM = $request->input('material_GSQM');
        $material->save();

        return redirect('/materials')->with('success', 'Zaktualizowano materiał');
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
        return redirect('/materials')->with('success', 'Usunięto materiał');
    }
}
