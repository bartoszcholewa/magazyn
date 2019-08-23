@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
@include('includes.messages')
    <h2 style="display: inline">Raport dla {{$material->material_NAME}}&nbsp;<a href="/rolls/create?material={{$material->material_ID}}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i>  Rolkę</a></h2>
    <hr>
    <div class="container-fluid raport">
        <div class="d-flex flex-row flex-nowrap">
            
            @foreach ($material->rolls->sortBy('roll_DATE') as $roll)
            @if($roll->roll_STATUS == 3)
            @else
            @php ($orderslenght = 0)
            <div class="col-3">
                <div class="card border-success">
                    <div class="card-header text-white bg-success">
                        <div class="row" style="font-size:0.6vw;">
                            <div class="col">
                                <a href="/rolls/{{$roll->roll_ID}}"><div class="white-link">{{$roll->roll_NAME}}</div></a>
                            </div>
                            <div class="col">
                                <p class="text-center">{{$roll->roll_DATE}}<p>
                            </div>
                            <div class="col">
                                @foreach ($roll->orders as $order)
                                    @if($order->order_ACTUAR_L)
                                        @php($orderslenght = $orderslenght + $order->order_ACTUAR_L)
                                    @else
                                        @php($orderslenght = $orderslenght + $order->order_SAFE_L)
                                    @endif
                                @endforeach
                                <p class="text-right"><b>{{$roll->roll_LENGTH - $orderslenght}}</b> mb</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                    <table class="table table-sm table-bordered" style="font-size:0.7vw;">
                        @foreach ($roll->orders as $order)  
                            @if($order->order_NAME == "0")

                                <thead>
                                    <tr>
                                        <td colspan="4">
                                            <p class="text-center"><a href="/orders/{{$order->order_ID}}">{{$order->order_CLIENT_NAME}} {{$order->order_CLIENT_SURNAME}} - {{$order->order_ACTUAR_L}}mb</a></p>
                                        </td>
                                    </tr>
                                </thead>
                            @else
                                <thead>
                                    <tr class="table-active">
                                        <td colspan="4">
                                            <b><a href="/orders/{{$order->order_ID}}">PW-{{$order->order_NAME}}</a></b> - <small>{{$order->order_DATE}}</small> 
                                        </td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            {{$order->order_CLIENT_NAME}} {{$order->order_CLIENT_SURNAME}} 
                                        </td>
                                        <td>
                                            {{$order->order_EXPECTED_L}}
                                        </td>
                                            <td>
                                            {{$order->order_SAFE_L}} 
                                        </td>
                                        <td>
                                            {{$order->order_ACTUAR_L}}
                                        </td>
                                    </tr>
                                </tbody>

                            @endif
                            
                        @endforeach
                    </table>  
                    <a href="/orders/create?material={{$material->material_ID}}&roll={{$roll->roll_ID}}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i>  Zlecenie</a>
                    <a href="/orders/create?material={{$material->material_ID}}&roll={{$roll->roll_ID}}&calibration=true" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i>  Kalibrację</a>
                    </div>
                    
                    </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</main>

@endsection