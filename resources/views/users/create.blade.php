@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowy użytkownik</h2>
    <hr>
    @php ($invalid = "form-control")
    {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col col-lg-4">

            <div class="form-group">
                {{Form::label('name', 'Nazwa:')}}
                @if($errors->has("name")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('name', '', ['class' => $invalid])}}
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ __('Username can not be empty.') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                {{Form::label('email', 'Adres E-Mail:')}}
                @if($errors->has("email")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('email', '', ['class' => $invalid])}}
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ __('Wrong e-mail or already used.') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                {{Form::label('type', 'Typ użytkownika:')}}
                {{Form::select('type', ['admin' => 'Admin', 'boss' => 'Boss', 'picturewall' => 'Picturewall', 'promax' => 'Promax'], 'promax', ['class' => "form-control"])}}
            </div>

            <div class="form-group">
                {{Form::label('password', 'Hasło:')}}
                @if($errors->has("password")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::password('password', ['class' => $invalid])}}
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ __('Wrong password.') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::label('password_confirm', 'Potwierdz hasło:')}}
                @if($errors->has("password_confirm")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::password('password_confirm', ['class' => $invalid])}}
                    @if ($errors->has('password_confirm'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ __('Passwords do not match.') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col col-lg-6">
            
            <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
            {{Form::submit('Dodaj', ['class'=>'btn btn-primary'])}}
        </div>
    </div>
    {!! Form::close() !!}
</main>
@endsection