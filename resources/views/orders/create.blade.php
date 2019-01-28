@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowe zlecenie @if (Request::get('material') !== NULL ) <small>(z magazynu)</small> @endif </h2>
    <hr>
    @php ($invalid = "form-control")
    {!! Form::open(['action' => 'OrdersController@store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col col-lg-4">

            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_NAME', 'Numer zlecenia:')}}
                        <div class="input-group mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">PW-</span>
                            </div>
                            @if($errors->has("order_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::text('order_NAME', '', ['class' => $invalid, 'aria-describedby' => 'basic-addon1', 'placeholder' => '000123'])}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_CLIENT_NAME', 'Klient - Imię:')}}
                        @if($errors->has("order_CLIENT_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('order_CLIENT_NAME', '', ['class' => $invalid])}}
                    </div>
                    <div class="col-sm no-gutter">
                        {{Form::label('order_CLIENT_SURNAME', 'Nazwisko:')}}
                        @if($errors->has("order_CLIENT_SURNAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('order_CLIENT_SURNAME', '', ['class' => $invalid])}}
                    </div>
                </div>
            </div>
            @if (Request::get('material') !== NULL )
            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_MATERIAL_ID', 'Materiał:')}}
                        @if($errors->has("order_MATERIAL_ID")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::select('order_MATERIAL_ID', $materials, Request::get('material'), ['class' => $invalid, 'placeholder' => 'Wybierz materiał...', 'disabled' => 'disabled'])}}

                    </div>
                    <div class="col-sm no-gutter">
                        {{Form::label('order_ROLL_ID', 'Rolka:')}}
                        @if($errors->has("order_ROLL_ID")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::select('order_ROLL_ID', $rolls, Request::get('roll'), ['class' => $invalid, 'placeholder' => 'Wybierz rolkę...', 'disabled'=> 'disabled'])}}
                    </div>
                </div>
            </div>

            @else
            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_MATERIAL_ID', 'Materiał:')}}
                        <select name="order_MATERIAL_ID" class="form-control">
                            <option value="">--Materiał--</option>
                            @foreach ($materials as $material => $value)
                            <option value="{{ $material }}"> {{ $value }}</option>   
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm no-gutter">
                        {{Form::label('order_ROLL_ID', 'Rolka:')}}
                        <select name="order_ROLL_ID" class="form-control">
                            <option>--Rolka--</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col col-lg">
                    <div class="form-group">
                        {{Form::label('order_EXPECTED_L', 'Dł. przewidziana:*')}}
                        <div class="input-group mb-12">
                            @if($errors->has("order_EXPECTED_L")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::number('order_EXPECTED_L', '', ['class' => $invalid, 'step'=>'any', 'placeholder' => 'np. 10', 'aria-describedby' => 'basic-addon2'])}}
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">mb</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg">
                    <div class="form-group">
                        {{Form::label('order_SAFE_L', 'Dł. bezpieczna:*')}}
                        <div class="input-group mb-12">
                            @if($errors->has("order_SAFE_L")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::number('order_SAFE_L', '', ['class' => $invalid, 'step'=>'any', 'placeholder' => 'np. 11', 'aria-describedby' => 'basic-addon2'])}}
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">mb</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_DATE', 'Data wejścia:')}}
                        @if($errors->has("order_DATE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::date('order_DATE', \Carbon\Carbon::today()->format('Y-m-d'), ['class' => $invalid])}}
                    </div>
                    <div class="col-sm no-gutter">
                        {{Form::label('order_CUTDATE', 'Data pocięcia:')}}
                        @if($errors->has("order_CUTDATE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::date('order_CUTDATE', \Carbon\Carbon::today()->addDays(3)->format('Y-m-d'), ['class' => $invalid])}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-lg">
                    <div class="form-group">
                        {{Form::label('order_pp_PEDIOD', 'Czas pracy plastyka:')}}
                        <div class="input-group mb-12">
                            @if($errors->has("order_pp_PEDIOD")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::number('order_pp_PEDIOD', '', ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">godz</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('order_DESCRIPTION', 'Opis zlecenia:')}}
                @if($errors->has("order_DESCRIPTION")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('order_DESCRIPTION', '', ['class' => $invalid])}}
            </div>

            <div class="form-group">
                {{Form::label('order_STATUS', 'Status zlecenia:')}}
                @if($errors->has("order_STATUS")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::select('order_STATUS', [0 => 'Nowe', 1 => 'Wydrukowane', 2 => 'Wysłane', 3 => 'Reklamacja'], 0, ['class' => $invalid])}}
            </div>
        </div>
    </div>

<br>

    {{-- <div class="row">
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
                                    {{Form::number('order_ACTUAR_L', '', ['class' => $invalid, 'step'=>'any', 'placeholder' => 'np. 10.5', 'aria-describedby' => 'basic-addon2'])}}
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
    </div><br> --}}

    <div class="row">
        <div class="col col-lg-4">

            <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
            {{Form::submit('Dodaj', ['class'=>'btn btn-primary'])}}

        </div>
    </div>
    {!! Form::close() !!}
    * wymagane



</main>
@endsection