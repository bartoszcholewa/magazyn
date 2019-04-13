<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Auth;
use Session;
use App\PlanPlastykow;
use App\Order;
use Carbon\Carbon;


class PlanPlastykowController extends Controller
{
    /**
     * Create a new controller instance.
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
    public function edycja()
    {
        if(in_array(Auth::user()->type, array('admin', 'boss'))){
            $weekMap = [
                1 => 'Poniedziałek',
                2 => 'Wtorek',
                3 => 'Środa',
                4 => 'Czwartek',
                5 => 'Piątek',
                6 => 'Sobota',
                0 => 'Niedziela',
            ];
            $pps = PlanPlastykow::orderBy('pp_DATE', 'asc')->get();
            $orders_no = Order::where('order_pp_ID', 0)->orderBy('order_DATE', 'asc')->get();
            Session::put('requestReferrer', URL::current());
            return view('planplastykow.edycja')->with([
                                                    'pps' => $pps, 
                                                    'weekMap' => $weekMap,
                                                    'orders_no' => $orders_no
                                                    ]);
        } else {
            return redirect('/planplastykow');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function podglad()
    {
        $weekMap = [
            1 => 'poniedziałek',
            2 => 'wtorek',
            3 => 'środa',
            4 => 'czwartek',
            5 => 'piątek',
            6 => 'sobota',
            0 => 'niedziela',
        ];
        $pps = PlanPlastykow::orderBy('pp_DATE', 'asc')->get();
        Session::put('requestReferrer', URL::current());
        return view('planplastykow.podglad')->with([
                                                'pps' => $pps, 
                                                'weekMap' => $weekMap,
                                                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrders(Request $request)
    {
        foreach ($request->orders as $order) {
            //Order::find($order['order_ID'])->update(['order_pp_ORDER' => $order['order_pp_ORDER']]);
            $updateOrder = Order::find($order['order_ID']);
            $updateOrder->order_pp_ID = $order['order_pp_ID'];
            $updateOrder->order_pp_ORDER = $order['order_pp_ORDER'];
            $updateOrder->timestamps = false;
            $updateOrder->save();

        }
        return response($request->orders);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateNiezaplanowane(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_pp_ID = $request->order_pp_ID;
        $order->timestamps = false;
        $order->save();
        
        return response($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
