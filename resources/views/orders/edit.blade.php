@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Edytuj zlecenie: PW-{{$order->order_NAME}}</h2>
    <hr>
    @php ($invalid = "form-control")
    {!! Form::open(['action' => ['OrdersController@update', $order->order_ID], 'method' => 'POST']) !!}
    <div class="row">
        <div class="col col-lg-4">

            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_NAME', 'Nazwa zlecenia:')}}
                        <div class="input-group mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">PW-</span>
                            </div>
                            @if($errors->has("order_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::text('order_NAME', $order->order_NAME, ['class' => $invalid, 'aria-describedby' => 'basic-addon1', 'placeholder' => '000123'])}}
                        </div>
                    </div>

                    <div class="col-sm no-gutter">
                        {{Form::label('order_DATE', 'Data zlecenia:')}}
                        @if($errors->has("order_DATE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::date('order_DATE', $order->order_DATE, ['class' => $invalid])}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('order_ROLL_ID', 'Rolka:')}}
                <div class="input-group mb-12">
                    @if($errors->has("order_ROLL_ID")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::select('order_ROLL_ID', $rolls, $order->order_ROLL_ID, ['class' => $invalid, 'placeholder' => 'Wybierz rolkę...'])}}
                    <div class="input-group-append">
                        <a class="btn btn-outline-primary" href="/rolls/create" role="button">Dodaj</a>
                    </div>
                </div>
            </div>

            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_CLIENT_NAME', 'Klient - Imię:')}}
                        @if($errors->has("order_CLIENT_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('order_CLIENT_NAME', $order->order_CLIENT_NAME, ['class' => $invalid, 'placeholder' => 'np. Jan'])}}
                    </div>
                    <div class="col-sm no-gutter">
                        {{Form::label('order_CLIENT_SURNAME', 'Nazwisko:')}}
                        @if($errors->has("order_CLIENT_SURNAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('order_CLIENT_SURNAME', $order->order_CLIENT_SURNAME, ['class' => $invalid, 'placeholder' => 'np. Kowalski'])}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('order_DESCRIPTION', 'Opis zlecenia:')}}
                @if($errors->has("order_DESCRIPTION")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('order_DESCRIPTION', $order->order_DESCRIPTION, ['class' => $invalid, 'placeholder' => 'np. odbiór osobisty'])}}
            </div>

            <div class="form-group">
                {{Form::label('order_STATUS', 'Status zlecenia:')}}
                @if($errors->has("order_STATUS")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::select('order_STATUS', [0 => 'Nowe', 1 => 'Wydrukowane', 2 => 'Wysłane', 3 => 'Reklamacja'], $order->order_STATUS, ['class' => $invalid])}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col col-lg-2">
            <div class="form-group">
                {{Form::label('order_EXPECTED_L', 'Dł. przewidziana:')}}
                <div class="input-group mb-12">
                    @if($errors->has("order_EXPECTED_L")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::number('order_EXPECTED_L', $order->order_EXPECTED_L, ['class' => $invalid, 'step'=>'any', 'placeholder' => 'np. 15.5', 'aria-describedby' => 'basic-addon2'])}}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">mb</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-lg-2">
            <div class="form-group">
                {{Form::label('order_SAFE_L', 'Dł. bezpieczna:')}}
                <div class="input-group mb-12">
                    @if($errors->has("order_SAFE_L")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::number('order_SAFE_L', $order->order_SAFE_L, ['class' => $invalid, 'step'=>'any', 'placeholder' => 'np. 15.5', 'aria-describedby' => 'basic-addon2'])}}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">mb</span>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <div class="row">
        <div class="col col-lg-4">
            <div class="card border-info">
                <div class="card-header text-white bg-info">
                    Kalkulator długości faktycznej
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-lg-6">
                            <div class="form-group">
                                <label for="num2">Dł. przed zleceniem:</label>
                                <input class="form-control" type="number" name="num1" id="num1" step="any" /> 
                            </div>
                        </div>
                        <div class="col col-lg-6">
                            <div class="form-group">
                                <label for="num2">Dł. po zleceniu:</label>
                                <input class="form-control" type="number" name="num2" id="num2" step="any" />
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col col-lg-6">
                            <div class="form-group">
                                {{Form::label('order_ACTUAR_L', 'Dł. faktyczna:')}}
                                <div class="input-group mb-12">
                                    @if($errors->has("order_ACTUAR_L")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                    {{Form::number('order_ACTUAR_L', $order->order_ACTUAR_L, ['class' => $invalid, 'step'=>'any', 'placeholder' => 'np. 10.5', 'aria-describedby' => 'basic-addon2'])}}
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">mb</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <div class="row">
        <div class="col col-lg-4">
            {{Form::hidden('_method', 'PUT')}}
            <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
            {{Form::submit('Zaktualizuj', ['class'=>'btn btn-primary'])}}

        </div>
    </div>

    {!! Form::close() !!}
    * wymagane
</main>
@endsection
