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
        /* eager loading */
        $rolls = Roll::with(['orders', 'material'])->withCount('orders')->get();
        
        /* actual size to each roll based on orders size */
        $new_rolls = $rolls->map(function ($roll) {
            $orders_lenght = 0;
            $orders_sum_expected = 0;
            $orders_sum_actual = 0;
            $orders_count = 0;
            
            $initial_roll_lenght = $roll->roll_LENGTH;
            foreach ($roll->orders as $order)
            {
                if(isset($order->order_ACTUAR_L))
                {
                    $orders_lenght = $orders_lenght + $order->order_ACTUAR_L;
                    $orders_sum_expected += $order->order_EXPECTED_L;
                    $orders_sum_actual += $order->order_ACTUAR_L;
                    $orders_count += 1;
                }
                else
                {
                    $orders_lenght = $orders_lenght + $order->order_SAFE_L;
                }
            }
            $roll['roll_ACTUAL_L'] = $initial_roll_lenght - $orders_lenght;
            if($orders_sum_actual - $orders_sum_expected == 0 || $orders_count == 0)
            {
                $roll['orders_average'] = 0;
            }
            else 
            {
                $roll['orders_average'] = ($orders_sum_actual - $orders_sum_expected) / $orders_count;
            }
            
            return $roll;
        });

        Session::put('requestReferrer', URL::current());
        return view('rolls.index')->with('rolls', $new_rolls);
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

        $redirect_respond = "Dodano <a href='rolls/".$roll->roll_ID."'>".$roll->roll_NAME."</a>";
        Controller::operation($redirect_respond);

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
        $roll = Roll::find($id);
        if(isset($roll))
        {
            return view('rolls.show')->with('roll', $roll);
        }
        else {
            return redirect(Session::get('requestReferrer'))->with('error', 'Ta rolka została usunięta.');
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

        $redirect_respond = "Zaktualizowano <a href='rolls/".$roll->roll_ID."'>".$roll->roll_NAME."</a>";
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
        $roll = Roll::find($id);
        $roll->delete();

        $redirect_respond = "Usunięto ".$roll->roll_NAME;
        Controller::operation($redirect_respond);

        return redirect(Session::get('requestReferrer'))->with('success', $redirect_respond);
    }
}
