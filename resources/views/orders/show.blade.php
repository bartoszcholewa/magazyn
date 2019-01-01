@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="col-md-6">
    <div class="row">
        <div class="col-sm-8">
        <h2>PW-{{$order->order_NAME}}</h2>
        <small>Dodano {{$order->created_at}} przez {{$order->creator->name}}</small> | 
        <small>Edytowano {{$order->updated_at}} przez {{$order->editor->name}}</small>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            @if(!Auth::guest())
                {!!Form::open(['action' => ['OrdersController@destroy', $order->order_ID], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
            @endif
            <button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
            @if(!Auth::guest())
                <a class="btn btn-primary btn-sm" href="/orders/{{$order->order_ID}}/edit" role="button">Edytuj</a>
                {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Are you sure?")'])}}
                {!!Form::close()!!}
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <p>Rolka: {{$order->roll->roll_NAME}}<br>
            Data: {{$order->order_DATE}}<br>
            Klient: {{$order->order_CLIENT_NAME}} {{$order->order_CLIENT_SURNAME}}<br>
            Opis: {{$order->order_DESCRIPTION}}<br>
            Status: {{$order->order_STATUS}}</p>
            <hr>
            <p>Przewidziana długość: {{$order->order_EXPECTED_L}}<br>
            Bezpieczna długość: {{$order->order_SAFE_L}}<br>
            Faktyczna długość: {{$order->order_ACTUAR_L}}</p>
        </div>
    </div>
    </div>
</main>
@endsection