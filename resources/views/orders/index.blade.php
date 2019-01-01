@extends('layouts.app')
@section('content')
@include('includes.messages')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="col-md-12">
    <h2>Zlecenia:</h2>
    @if (count($orders) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">      
                <thead>
                    <tr>
                        <th>Nazwa zlecenia</th>
                        <th>Rolka</th>
                        <th>Klient</th>
                        <th>Opis</th>
                        <th>Status</th>
                        <th>Przewidziana długość</th>
                        <th>Bezpieczna długość</th>
                        <th>Faktyczna długość</th>
                    </tr>
                </thead>     
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><a href="/orders/{{$order->order_ID}}">PW-{{$order->order_NAME}}</td>
                        <td>{{$order->roll->roll_NAME}}</td>
                        <td>{{$order->order_CLIENT_NAME}} {{$order->order_CLIENT_SURNAME}}</td>
                        <td>{{$order->order_DESCRIPTION}}</td>
                        <td>{{$order->order_STATUS}}</td>
                        <td>{{$order->order_EXPECTED_L}}</td>
                        <td>{{$order->order_SAFE_L}}</td>
                        <td>{{$order->order_ACTUAR_L}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Brak dodanych zleceń</p>
        @endif
    <a class="btn btn-primary" href="/orders/create" role="button">Nowe zlecenie</a>
    </div>
</main>
@endsection