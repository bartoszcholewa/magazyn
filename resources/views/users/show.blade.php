@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-8">
            <h2>{{$user->name}}</h2><small>Dodano {{$user->created_at}}| <small>Edytowano {{$user->updated_at}}</small>        
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @if(!Auth::guest())
                    {!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                @endif
                <button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
                @if(!Auth::guest())
                    <a class="btn btn-primary btn-sm" href="/users/{{$user->id}}/edit" role="button">Edytuj</a>
                    {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Czy napewno chcesz usunąć?")'])}}
                    {!!Form::close()!!}
                @endif
            </div>
        </div>
    </div>
</main>
@endsection