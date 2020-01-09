@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-8">
            <h2>{{$envelope->envelope_NAME}}</h2><small>Dodano {{$envelope->created_at}} | 
            <small>Edytowano {{$envelope->updated_at}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @if(!Auth::guest())
                    {!!Form::open(['action' => ['EnvelopesController@destroy', $envelope->envelope_ID], 'method' => 'POST'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                @endif
                <button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
                @if(!Auth::guest())
                    <a class="btn btn-primary btn-sm" href="/koperty/{{$envelope->envelope_ID}}/edit" role="button">Edytuj</a>
                    {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Czy napewno chcesz usunąć?")'])}}
                    {!!Form::close()!!}
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <p>Nazwa własna: {{$envelope->envelope_NAME}}<br>
                Firma: {{$envelope->envelope_COMPANY}}<br>
                Klient: {{$envelope->envelope_PERSON}}<br>
                Ulica: {{$envelope->envelope_STREET}}<br>
                Kod Pocztowy: {{$envelope->envelope_ZIPCODE}}</p>
                Miasto: {{$envelope->envelope_CITY}}</p>
                Kraj: {{$envelope->envelope_COUNTRY}}</p>
            </div>
        </div>
    </div>
</main>
@endsection