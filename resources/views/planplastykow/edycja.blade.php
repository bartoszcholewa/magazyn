@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2 style="display: inline">PLAN PLASTYKÓW</h2>
    <hr>  
    @foreach ($pps as $pp)
        @foreach ($pp->orders as $order)    
        @endforeach
    @endforeach
    <div id='app'>
        <plan-plastykow :pps="{{ $pps }}"></plan-plastykow>
        <niezaplanowane :orders_no="{{ $orders_no }}"></niezaplanowane>
    </div>
    
</main>

@endsection