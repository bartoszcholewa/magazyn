@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="col-md-6">
    <div class="row">
        <div class="col-sm-8">
        <h2>Rolka {{$roll->roll_NAME}}</h2><small>Dodano {{$roll->created_at}} przez {{$roll->creator->name}}</small> | 
        <small>Edytowano {{$roll->updated_at}} przez {{$roll->editor->name}}</small>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            @if(!Auth::guest())
                {!!Form::open(['action' => ['RollsController@destroy', $roll->roll_ID], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
            @endif
            <button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
            @if(!Auth::guest())
                <a class="btn btn-primary btn-sm" href="/rolls/{{$roll->roll_ID}}/edit" role="button">Edytuj</a>
                {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Czy napewno chcesz usunąć?")'])}}
                {!!Form::close()!!}
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <p>Materiał: {{$roll->material->material_NAME}}<br>
            Data: {{$roll->roll_DATE}}<br>
            Status:
            @if($roll->roll_STATUS == 0) Nowa @endif
            @if($roll->roll_STATUS == 1) W użyciu @endif
            @if($roll->roll_STATUS == 2) Resztka @endif
            @if($roll->roll_STATUS == 3) Zakończona @endif<br>
            Opis: {{$roll->roll_DESCRIPTION}}<br>
            Długość początkowa: {{$roll->roll_LENGTH}}m<br>
            Uszkodzona: @if($roll->roll_DEFECTED == 0) Nie @else Tak @endif<br>
            Faktura: <a href="/storage/faktury/{{$roll->roll_INVOICE_FILE}}">{{$roll->roll_INVOICE_NR}}</a><br>
            Status faktury: {{$roll->roll_INVOICE_STATUS}}</p>
            
        </div>
    </div>
    </div>
</main>
@endsection