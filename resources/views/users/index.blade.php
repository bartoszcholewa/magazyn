@extends('layouts.app')
@section('content')
@include('includes.messages')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="col-md-12">
    <h2 style="display: inline-block">Użytkownicy: &nbsp;<a class="btn btn-primary btn-sm" href="/users/create"><i class="fas fa-plus-circle"></i>  Użytkownika</a></h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">      
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Email</th>
                        <th>Typ</th>
                        <th>Zweryfikowany</th>
                        <th>Utworzony</th>
                        <th>Edytowany</th>
                        <th>Edycja<th>
                    </tr>
                </thead>     
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td><a href="users/{{$user->id}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->type}}</td>
                        <td>{{$user->email_verified_at}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td>
                            @if($user->id == 1)
                                <a class="btn btn-primary btn-sm" href="/users/{{ $user->id }}/edit" role="button">Edytuj</a>
                                <a class="btn btn-secondary btn-sm" href="/users/{{ $user->id }}/changepassword" role="button">Zmień hasło</a>
                            @else
                                {!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                <a class="btn btn-primary btn-sm" href="/users/{{ $user->id }}/edit" role="button">Edytuj</a>
                                <a class="btn btn-secondary btn-sm" href="/users/{{ $user->id }}/changepassword" role="button">Zmień hasło</a>
                                {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Czy napewno chcesz usunąć?")'])}}
                                {!!Form::close()!!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection