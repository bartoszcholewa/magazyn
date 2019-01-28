@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Edytuj Użytkownika: {{$user->name}}</h2>
    <hr>
    @php ($invalid = "form-control")
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}
    <div class="row">
        <div class="col col-lg-4">

            <div class="form-group">
                {{Form::label('name', 'Nazwa:')}}
                @if($errors->has("name")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('name', $user->name, ['class' => $invalid])}}
            </div>

            <div class="form-group">
                {{Form::label('email', 'Adres E-Mail:')}}
                @if($errors->has("email")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('email', $user->email, ['class' => $invalid])}}
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col col-lg-6">
            {{Form::hidden('_method', 'PUT')}}
            <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
            {{Form::submit('Zaktualizuj', ['class'=>'btn btn-primary'])}}
        </div>
    </div>
    {!! Form::close() !!}
</main>
@endsection