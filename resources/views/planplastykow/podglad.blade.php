@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2 style="display: inline">PLAN PLASTYKÓW</h2>
    <hr>
    <div class="container-fluid raport mb-2">
        <div class="d-flex flex-row flex-nowrap">
            @foreach ($pps as $pp)
            <div class="col-2" style="padding:1px;font-size:0.7vw;">
                <div class="card border-success">
                    <div class="card-header text-white bg-success">
                        <div class="row">
                            <div class="col">
                                <p class="text-center"> {{$pp->pp_DATE}} - {{$weekMap[Carbon\Carbon::parse($pp->pp_DATE)->dayOfWeek]}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    @foreach ($pp->orders as $order)
                    
                        <div class="card mb-2">
                            <div class="card-body">
                                <a href="/orders/{{$order->order_ID}}">PW-{{$order->order_NAME}}</a>
                                <p class="card-text">{{$order->order_CLIENT_NAME}} {{$order->order_CLIENT_SURNAME}}</p>
                            </div>
                            <div class="card-footer text-muted">
                                Planowany czas: {{$order->order_pp_PEDIOD}} godz
                            </div>
                        </div>
                    @endforeach   
                    </div>           
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
</main>

@endsection