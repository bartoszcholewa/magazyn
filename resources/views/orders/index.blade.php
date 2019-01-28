@extends('layouts.app')
@section('content')
@include('includes.messages')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">  
    <div class="col-md-12">
        <h2 style="display: inline-block">Zlecenia: &nbsp;  <a class="btn btn-primary btn-sm" href="/orders/create" role="button"><i class="fas fa-plus-circle"></i> Zlecenie</a></h2>
        @if (count($orders) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-sm">      
                    <thead>
                        <tr>
                            <th>Nazwa zlecenia</th>
                            <th>Klient</th>
                            <th>Materiał</th>
                            <th>Rolka</th>
                            <th>Status</th>
                            <th><div title="Przewidziana długość">P.D.</div></th>
                            <th><div title="Bezpieczna długość">B.D.</div></th>
                            <th><div title="Faktyczna długość">F.D.</div></th>
                        </tr>
                    </thead>     
                    <tbody>
                    @foreach ($orders as $order)
                        @if($order->order_NAME == "0") @else
                            <tr>
                                <td><a href="/orders/{{$order->order_ID}}">PW-{{$order->order_NAME}}</td>
                                <td>{{$order->order_CLIENT_NAME}} {{$order->order_CLIENT_SURNAME}}</td>
                                <td>{{$order->material->material_NAME}}</td>
                                <td>{{$order->roll->roll_NAME}}</td>
                                <td>
                                    @if($order->order_STATUS == 0) Nowe @endif
                                    @if($order->order_STATUS == 1) Wydrukowane @endif
                                    @if($order->order_STATUS == 2) Wysłane @endif
                                    @if($order->order_STATUS == 3) Reklamacja @endif
                                </td>
                                <td>{{$order->order_EXPECTED_L}}</td>
                                <td>{{$order->order_SAFE_L}}</td>
                                <td>{{$order->order_ACTUAR_L}}</td>
                            </tr>
                        @endif
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
            <div class="float-left">Zlecenia {{$orders->firstItem()}} - {{$orders->lastItem()}} z {{$orders->total()}}</div>
            <div class="float-right">{{$orders->links()}}</div>
            
            @else
                <p>Brak dodanych zleceń</p>
            @endif
    
    </div>
</main>
@endsection