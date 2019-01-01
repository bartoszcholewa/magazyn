<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;
use App\Material;
use App\Supplier;
use App\Roll;
use App\Order;

class RollsController extends Controller
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
        // Load rolls table + load for each coresponding orders
        $rolls = Roll::withCount('orders')->get(); 
        Session::put('requestReferrer', URL::current());
        return view('rolls.index')->with('rolls', $rolls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::all()->pluck('material_NAME', 'material_ID')->toArray();
        return view('rolls.create')->with('materials', $materials);
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
            'roll_NAME' => 'required',
            'roll_MATERIAL_ID' => 'required',
            'roll_DATE' => 'nullable',
            'roll_INVOICE_NR' => 'nullable',
            'roll_INVOICE_FILE' => 'nullable',
            'roll_INVOICE_STATUS' => 'nullable',
            'roll_DESCRIPTION' => 'nullable',
            'roll_STATUS' => 'nullable',
            'roll_DEFECTED' => 'nullable',
            'roll_LENGTH' => 'nullable'
        ]);
        $roll = new Roll;
        $roll_MATERIAL_ID = $request->input('roll_MATERIAL_ID');
        $roll->roll_MATERIAL_ID = $request->input('roll_MATERIAL_ID');
        $roll->roll_NAME = $request->input('roll_NAME');
        $roll->roll_DATE = $request->input('roll_DATE');
        $roll->roll_INVOICE_NR = $request->input('roll_INVOICE_NR');
        $roll->roll_INVOICE_FILE = $request->input('roll_INVOICE_FILE');
        $roll->roll_INVOICE_STATUS = $request->input('roll_INVOICE_STATUS');
        $roll->roll_DESCRIPTION = $request->input('roll_DESCRIPTION');
        $roll->roll_STATUS = $request->input('roll_STATUS');
        if($request->input('roll_DEFECTED') == NULL){
            $roll->roll_DEFECTED = 0;
        } else {
            $roll->roll_DEFECTED = 1;
        }
        if($request->input('roll_LENGTH') == NULL){
            $roll->roll_LENGTH = Material::where('material_ID', $roll_MATERIAL_ID)->value('material_LENGTH');
        } else {
            $roll->roll_LENGTH = $request->input('roll_LENGTH');
        }
        $roll->roll_CREATOR = auth()->user()->id;
        $roll->roll_EDITOR = auth()->user()->id;
        $roll->save();

        //return redirect('/rolls')->with('success', 'Dodano nową rolkę');
        //return redirect(Session::get('requestReferrer'))->with('success', 'Dodano nową rolkę');
        return redirect(Session::get('requestReferrer'))->with('success', 'Dodano nową rolkę: <b>'.$request->input('roll_NAME').'</b>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roll = Roll::find($id);
        return view('rolls.show')->with('roll', $roll);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roll = Roll::find($id);
        $materials = Material::all()->pluck('material_NAME', 'material_ID')->toArray();
        return view('rolls.edit', compact('roll', 'materials'));
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
            'roll_NAME' => 'required',
            'roll_MATERIAL_ID' => 'required',
            'roll_DATE' => 'nullable',
            'roll_INVOICE_NR' => 'nullable',
            'roll_INVOICE_FILE' => 'nullable',
            'roll_INVOICE_STATUS' => 'nullable',
            'roll_DESCRIPTION' => 'nullable',
            'roll_STATUS' => 'nullable',
            'roll_DEFECTED' => 'nullable',
            'roll_LENGTH' => 'nullable'
        ]);
        $roll = Roll::find($id);
        $roll_MATERIAL_ID = $request->input('roll_MATERIAL_ID');
        $roll->roll_MATERIAL_ID = $request->input('roll_MATERIAL_ID');
        $roll->roll_NAME = $request->input('roll_NAME');
        $roll->roll_DATE = $request->input('roll_DATE');
        $roll->roll_INVOICE_NR = $request->input('roll_INVOICE_NR');
        $roll->roll_INVOICE_FILE = $request->input('roll_INVOICE_FILE');
        $roll->roll_INVOICE_STATUS = $request->input('roll_INVOICE_STATUS');
        $roll->roll_DESCRIPTION = $request->input('roll_DESCRIPTION');
        $roll->roll_STATUS = $request->input('roll_STATUS');
        if($request->input('roll_DEFECTED') == NULL){
            $roll->roll_DEFECTED = 0;
        } else {
            $roll->roll_DEFECTED = 1;
        }
        if($request->input('roll_LENGTH') == NULL){
            $roll->roll_LENGTH = Material::where('material_ID', $roll_MATERIAL_ID)->value('material_LENGTH');
        } else {
            $roll->roll_LENGTH = $request->input('roll_LENGTH');
        }
        $roll->roll_EDITOR = auth()->user()->id;
        $roll->save();

        //return redirect()->route('rolls.show', $roll->roll_ID)->with('success', 'Zaktualizowano rolkę');
        //return redirect(Session::get('requestReferrer'))->with('success', 'Zaktualizowano rolkę');
        return redirect(Session::get('requestReferrer'))->with('success', 'Zaktualizowano rolkę: <b>'.$request->input('roll_NAME').'</b>');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roll = Roll::find($id);
        $roll->delete();
        //return redirect('/rolls')->with('success', 'Usunięto rolkę');
        //return redirect(Session::get('requestReferrerDelete'))->with('success', 'Usunięto rolkę');
        return redirect(Session::get('requestReferrer'))->with('success', 'Usunięto rolkę: <b>'.$roll->roll_NAME.'</b>');
    }
}
