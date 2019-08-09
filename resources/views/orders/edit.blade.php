@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    @if($order->order_NAME == "0")
        <h2>Edycja kalibracji</h2>
        @php ($invalid = "form-control") @endphp
        {!! Form::open(['action' => ['OrdersController@update', $order->order_ID], 'method' => 'POST']) !!}
        {{ Form::hidden('order_NAME', $order->order_NAME) }}
        {{ Form::hidden('order_DATE', $order->order_DATE) }}
        {{ Form::hidden('order_CLIENT_NAME', $order->order_CLIENT_NAME) }}
        {{ Form::hidden('order_CLIENT_SURNAME',  $order->order_CLIENT_SURNAME) }}
        {{ Form::hidden('order_EXPECTED_L',  $order->order_EXPECTED_L) }}
        {{ Form::hidden('order_SAFE_L',  $order->order_SAFE_L) }}
        {{ Form::hidden('order_STATUS',  $order->order_STATUS) }}
        {{ Form::hidden('order_MATERIAL_ID',  $order->order_MATERIAL_ID) }}
        {{ Form::hidden('order_ROLL_ID',  $order->order_ROLL_ID) }}

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
                    {{Form::submit('Edytuj', ['class'=>'btn btn-primary'])}}

                </div>
            </div>
        {!! Form::close() !!}

    @else
        <h2>Edycja zlecenia: PW-{{$order->order_NAME}}</h2>
        <hr>
        @php ($invalid = "form-control")  @endphp

        {!! Form::open(['action' => ['OrdersController@update', $order->order_ID], 'method' => 'POST']) !!}

        
        <div class="row">
            <div class="col col-lg-4 border-right">
                <div class="form-group no-gutter">
                    <div class="row">
                        <div class="col-sm no-gutter">
                            {{Form::label('order_NAME', 'Numer zlecenia:')}}
                            <div class="input-group mb-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">PW-</span>
                                </div>
                                @if($errors->has("order_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                {{Form::text('order_NAME', $order->order_NAME, ['class' => $invalid, 'aria-describedby' => 'basic-addon1', 'placeholder' => '000123'])}}
                                @if ($errors->has('order_NAME'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('Order with that number already exist.') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col col-lg-4">
                            <div class="form-group">
                                {{Form::label('order_QUANTITY', 'Ilość:')}}
                                <div class="input-group mb-12">
                                    {{Form::number('order_QUANTITY', $order->order_QUANTITY, ['class' => 'form-control', 'step'=>'any', 'placeholder' => 'np. 5', 'aria-describedby' => 'basic-addon2'])}}
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">szt.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group no-gutter">
                    <div class="row">
                        <div class="col-sm no-gutter">
                            {{Form::label('order_CLIENT_NAME', 'Klient - Imię:')}}
                            @if($errors->has("order_CLIENT_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::text('order_CLIENT_NAME', $order->order_CLIENT_NAME, ['class' => $invalid])}}
                            @if ($errors->has('order_CLIENT_NAME'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __('Field required.') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm no-gutter">
                            {{Form::label('order_CLIENT_SURNAME', 'Nazwisko:')}}
                            @if($errors->has("order_CLIENT_SURNAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::text('order_CLIENT_SURNAME', $order->order_CLIENT_SURNAME, ['class' => $invalid])}}
                            @if ($errors->has('order_CLIENT_SURNAME'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __('Field required.') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group no-gutter">
                    <div class="row">
                        <div class="col-sm no-gutter">
                            {{Form::label('order_MATERIAL_ID', 'Materiał:')}}
                            @if($errors->has("order_MATERIAL_ID")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::select('order_MATERIAL_ID', $materials, $order->order_MATERIAL_ID, ['class' => $invalid, 'placeholder' => 'Wybierz materiał...'])}}
                            @if ($errors->has('order_MATERIAL_ID'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __('Field required.') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm no-gutter">
                            {{Form::label('order_ROLL_ID', 'Rolka:')}}
                            {{Form::select('order_ROLL_ID', $rolls, $order->order_ROLL_ID, ['class' => $invalid, 'placeholder' => 'Wybierz rolkę...',])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-lg">
                        <div class="form-group">
                            {{Form::label('order_EXPECTED_L', 'Dł. przewidziana:')}}
                            <div class="input-group mb-12">
                                @if($errors->has("order_EXPECTED_L")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                {{Form::number('order_EXPECTED_L', $order->order_EXPECTED_L, ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">mb</span>
                                </div>
                                @if ($errors->has('order_EXPECTED_L'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('Field required.') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg">
                        <div class="form-group">
                            {{Form::label('order_SAFE_L', 'Dł. bezpieczna:')}}
                            <div class="input-group mb-12">
                                @if($errors->has("order_SAFE_L")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                {{Form::number('order_SAFE_L', $order->order_SAFE_L, ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">mb</span>
                                </div>
                                @if ($errors->has('order_SAFE_L'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('Field required.') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-lg">
                        <div class="form-group">
                            <label for="num2">Dł. przed zleceniem:</label>
                            <input class="form-control" type="number" name="num1" id="num1" step="any" />
                        </div>
                    </div>
                    <div class="col col-lg">
                        <div class="form-group">
                            <label for="num2">Dł. po zleceniu:</label>
                            <input class="form-control" type="number" name="num2" id="num2" step="any" />
                        </div>
                    </div>
                    <div class="col col-lg">
                        <div class="form-group">
                            {{Form::label('order_ACTUAR_L', 'Dł. faktyczna:')}}
                            <div class="input-group mb-12">
                                {{Form::number('order_ACTUAR_L', $order->order_ACTUAR_L, ['class' => 'form-control', 'step'=>'any', 'placeholder' => 'np. 10.5', 'aria-describedby' => 'basic-addon2'])}}
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
                            {{Form::date('order_DATE', $order->order_DATE, ['class' => $invalid])}}
                        </div>
                        <div class="col-sm no-gutter">
                            {{Form::label('order_CUTDATE', 'Data pocięcia:')}}
                            @if($errors->has("order_CUTDATE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::date('order_CUTDATE', $order->order_CUTDATE, ['class' => $invalid])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-lg">
                        <div class="form-group">
                            {{Form::label('order_pp_PERIOD', 'Czas pracy plastyka:')}}
                            <div class="input-group mb-12">
                                {{Form::number('order_pp_PERIOD', $order->order_pp_PERIOD, ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">godz</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('order_STATUS', 'Status zlecenia:')}}
                    {{Form::select('order_STATUS', [0 => 'Nowe', 1 => 'Wydrukowane', 2 => 'Wysłane', 3 => 'Reklamacja'], $order->order_STATUS, ['class' => $invalid])}}
                </div>

            </div>
            <div class="col col-lg-4">
                <div class="form-group">
                    {{Form::label('order_URL', 'URL podglądu:')}}
                    <div class="input-group mb-12">
                        @if($errors->has("order_URL")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('order_URL', $order->order_URL, ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Wykryj</button>
                        </div>
                        @if ($errors->has('order_URL'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ __('Invalid URL format.') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('order_EFFECTS', 'Efekty:')}}
                    {{Form::select('order_EFFECTS', [0 => 'Bez efektu', 1 => 'Czarno-Biały', 2 => 'Sepia', 3 => 'Cold'], $order->order_EFFECTS, ['class' => $invalid])}}
                </div>

                <div class="form-group no-gutter">
                    <div class="row">
                        <div class="col-sm no-gutter">
                            {{Form::label('order_ROTATION', 'Obrót')}} &nbsp; <i class="fas fa-undo"></i>
                            {{Form::select('order_ROTATION', [0 => 'Brak', 90 => '90°', 180 => '180°', 270 => '270°', 360 => '360°'], $order->order_ROTATION, ['class' => $invalid])}}
                        </div>

                        <div class="col-sm no-gutter">
                            {{Form::label('order_FLIP_X', 'Odbicie poziome')}} &nbsp; <i class="fas fa-arrows-alt-h"></i>
                            {{Form::select('order_FLIP_X', ['false' => 'Nie', 'true' => 'Tak'], $order->order_FLIP_X, ['class' => $invalid])}}
                        </div>

                        <div class="col-sm no-gutter">
                            {{Form::label('order_FLIP_Y', 'Odbicie pionowe')}} &nbsp; <i class="fas fa-arrows-alt-v"></i>
                            {{Form::select('order_FLIP_Y', ['false' => 'Nie', 'true' => 'Tak'], $order->order_FLIP_Y, ['class' => $invalid])}}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('order_OVERLAP', 'Zakładka:')}}
                    {{Form::select('order_OVERLAP', [0 => 'Brak', 1 => '0,5cm', 2 => '1cm', 3 => 'Inna'], $order->order_OVERLAP, ['class' => $invalid])}}
                </div>

                <div class="form-group">
                    {{Form::label('order_LAMINATE', 'Laminat:')}}
                    {{Form::select('order_LAMINATE', [0 => 'Nie', 1 => 'Tak'], $order->order_LAMINATE, ['class' => $invalid])}}
                </div>

                <div class="form-group">
                    {{Form::label('order_GLUE', 'Klej:')}}
                    {{Form::select('order_GLUE', [0 => 'Brak', 1 => 'Metylan Special (lateksowe)', 2 => 'Metylan Direct (winylowe)', 3 => 'Metylan do krawędzi'], $order->order_GLUE, ['class' => $invalid])}}
                </div>

                <div class="form-group">
                    {{Form::label('order_DESCRIPTION', 'Uwagi do zlecenia:')}}
                    {{Form::textarea('order_DESCRIPTION', $order->order_DESCRIPTION, ['class' => $invalid, 'rows' => 5])}}
                </div>
                
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col col-lg-4">
                {{Form::hidden('_method', 'PUT')}}
                <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
                {{Form::submit('Zaktualizuj', ['class'=>'btn btn-primary'])}}

            </div>
        </div>
        {!! Form::close() !!}
    @endif
</main>
@endsection