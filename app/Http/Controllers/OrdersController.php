<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;
use App\Material;
use App\Supplier;
use App\Order;
use App\Roll;

class OrdersController extends Controller
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
        //$orders = Order::all();
        $orders = Order::orderBy('order_NAME', 'desc')->paginate(20);
        Session::put('requestReferrer', URL::current());
        return view('orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rolls = Roll::all()->pluck('roll_NAME', 'roll_ID')->toArray();;
        return view('orders.create')->with('rolls', $rolls);
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
            'order_ROLL_ID' => 'required',
            'order_NAME' => 'required',
            'order_DATE' => 'required',
            'order_CLIENT_NAME' => 'required',
            'order_CLIENT_SURNAME' => 'required',
            'order_EXPECTED_L' => 'required',
            'order_SAFE_L' => 'required',
            'order_ACTUAR_L' => 'nullable',
            'order_DESCRIPTION' => 'nullable',
            'order_STATUS' => 'nullable',
        ]);
        $order = new Order;
        $order->order_ROLL_ID = $request->input('order_ROLL_ID');
        $order->order_NAME = $request->input('order_NAME');
        $order->order_DATE = $request->input('order_DATE');
        $order->order_CLIENT_NAME = $request->input('order_CLIENT_NAME');
        $order->order_CLIENT_SURNAME = $request->input('order_CLIENT_SURNAME');
        $order->order_EXPECTED_L = $request->input('order_EXPECTED_L');
        $order->order_SAFE_L = $request->input('order_SAFE_L');
        $order->order_ACTUAR_L = $request->input('order_ACTUAR_L');
        $order->order_DESCRIPTION = $request->input('order_DESCRIPTION');
        $order->order_STATUS = $request->input('order_STATUS');
        $order->order_CREATOR_ID = auth()->user()->id;
        $order->order_EDITOR_ID = auth()->user()->id;
        $order->order_pp_ID = 0;
        $order->order_pp_ORDER = 0;
        $order->order_pp_PEDIOD = 1;
        $order->save();

        //return redirect()->back()->with('success', 'Dodano nowe zlecenie');
        return redirect(Session::get('requestReferrer'))->with('success', 'Dodano nowe zlecenie: <b>PW-'.$request->input('order_NAME').'</b>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $rolls = Roll::all()->pluck('roll_NAME', 'roll_ID')->toArray();
        return view('orders.edit', compact('order', 'rolls'));
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
            'order_ROLL_ID' => 'required',
            'order_NAME' => 'required',
            'order_DATE' => 'required',
            'order_CLIENT_NAME' => 'required',
            'order_CLIENT_SURNAME' => 'required',
            'order_EXPECTED_L' => 'required',
            'order_SAFE_L' => 'required',
            'order_ACTUAR_L' => 'nullable',
            'order_DESCRIPTION' => 'nullable',
            'order_STATUS' => 'nullable',
        ]);
        $order = Order::find($id);
        $order->order_ROLL_ID = $request->input('order_ROLL_ID');
        $order->order_NAME = $request->input('order_NAME');
        $order->order_DATE = $request->input('order_DATE');
        $order->order_CLIENT_NAME = $request->input('order_CLIENT_NAME');
        $order->order_CLIENT_SURNAME = $request->input('order_CLIENT_SURNAME');
        $order->order_EXPECTED_L = $request->input('order_EXPECTED_L');
        $order->order_SAFE_L = $request->input('order_SAFE_L');
        $order->order_ACTUAR_L = $request->input('order_ACTUAR_L');
        $order->order_DESCRIPTION = $request->input('order_DESCRIPTION');
        $order->order_STATUS = $request->input('order_STATUS');
        $order->order_EDITOR_ID = auth()->user()->id;
        $order->save();

        //return redirect()->route('orders.show', $order->order_ID)->with('success', 'Zaktualizowano zlecenie');
        return redirect(Session::get('requestReferrer'))->with('success', 'Zaktualizowano zlecenie: <b>PW-'.$request->input('order_NAME').'</b>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        //return redirect('/orders')->with('success', 'Usunięto zlecenie');
        return redirect(Session::get('requestReferrer'))->with('success', 'Usunięto zlecenie <b>PW-'.$order->order_NAME.'</b>');
    }
}
