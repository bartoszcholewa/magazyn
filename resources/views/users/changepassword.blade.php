@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Zmień hasło: {{$user->name}}</h2>
    <hr>
    @php ($invalid = "form-control")
    {!! Form::open(['action' => ['UsersController@updatepassword', $user->id], 'method' => 'POST']) !!}
    <div class="row">
        <div class="col col-lg-4">

            <div class="form-group">
                {{Form::label('password', 'Nowe hasło:')}}
                @if($errors->has("password")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::password('password', ['class' => $invalid])}}
            </div>
            <div class="form-group">
                {{Form::label('password_confirm', 'Potwierdz nowe hasło:')}}
                @if($errors->has("password_confirm")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::password('password_confirm', ['class' => $invalid])}}
            </div>


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