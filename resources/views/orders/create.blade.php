@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    @if(Request::get('calibration'))
        <h2>Kalibracja</h2>
        @php ($invalid = "form-control")  @endphp
        {!! Form::open(['action' => 'OrdersController@store', 'method' => 'POST']) !!}

        {{ Form::hidden('order_NAME', '0') }}
        {{ Form::hidden('order_DATE', \Carbon\Carbon::today()->format('Y-m-d')) }}
        {{ Form::hidden('order_CLIENT_NAME', 'Kalibracja') }}
        {{ Form::hidden('order_CLIENT_SURNAME', 'Maszyny') }}
        {{ Form::hidden('order_EXPECTED_L', 0) }}
        {{ Form::hidden('order_SAFE_L', 0) }}
        {{ Form::hidden('order_STATUS', '1') }}
        {{ Form::hidden('order_MATERIAL_ID', Request::get('material')) }}
        {{ Form::hidden('order_ROLL_ID', Request::get('roll')) }}

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
            </div><br>


            <div class="row">
                <div class="col col-lg-4">

                    <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
                    {{Form::submit('Dodaj', ['class'=>'btn btn-primary'])}}

                </div>
            </div>
        {!! Form::close() !!}

    @else
    <h2>Nowe zlecenie @if (Request::get('material') !== NULL ) <small>(z magazynu)</small> @endif </h2>
    <hr>
    @php ($invalid = "form-control")  @endphp

    {!! Form::open(['action' => 'OrdersController@store', 'method' => 'POST']) !!}

    
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
                            {{Form::text('order_NAME', $giveNextOrder, ['class' => $invalid, 'aria-describedby' => 'basic-addon1', 'placeholder' => '000123'])}}
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
                                {{Form::number('order_QUANTITY', 1, ['class' => 'form-control', 'step'=>'any', 'placeholder' => 'np. 5', 'aria-describedby' => 'basic-addon2'])}}
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
                        {{Form::text('order_CLIENT_NAME', $giveSameName, ['class' => $invalid])}}
                        @if ($errors->has('order_CLIENT_NAME'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ __('Field required.') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm no-gutter">
                        {{Form::label('order_CLIENT_SURNAME', 'Nazwisko:')}}
                        @if($errors->has("order_CLIENT_SURNAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('order_CLIENT_SURNAME', $giveSameSurname, ['class' => $invalid])}}
                        @if ($errors->has('order_CLIENT_SURNAME'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ __('Field required.') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @if (Request::get('material') !== NULL )
            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_MATERIAL_ID', 'Materiał:')}}
                        @if($errors->has("order_MATERIAL_ID")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::select('order_MATERIAL_ID', $materials, Request::get('material'), ['class' => $invalid, 'placeholder' => 'Wybierz materiał...', 'readonly'])}}
                        @if ($errors->has('order_MATERIAL_ID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ __('Field required.') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm no-gutter">
                        {{Form::label('order_ROLL_ID', 'Rolka:')}}
                        {{Form::select('order_ROLL_ID', $rolls, Request::get('roll'), ['class' => $invalid, 'placeholder' => 'Wybierz rolkę...', 'readonly'])}}
                    </div>
                </div>
            </div>

            @else
            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('order_MATERIAL_ID', 'Materiał:')}}
                        @if($errors->has("order_MATERIAL_ID")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        <select name="order_MATERIAL_ID" class="{{$invalid}}">
                            <option value="">--Materiał--</option>
                            @foreach ($materials as $material => $value)
                            <option value="{{ $material }}"> {{ $value }}</option>   
                            @endforeach
                        </select>
                        @if ($errors->has('order_MATERIAL_ID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ __('Field required.') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm no-gutter">
                        {{Form::label('order_ROLL_ID', 'Rolka:')}}
                        <select name="order_ROLL_ID" class={{$invalid}}>
                            <option>--Rolka--</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col col-lg">
                    <div class="form-group">
                        {{Form::label('order_EXPECTED_L', 'Dł. przewidziana:')}}
                        <div class="input-group mb-12">
                            @if($errors->has("order_EXPECTED_L")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::number('order_EXPECTED_L', '', ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
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
                            {{Form::number('order_SAFE_L', '', ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
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
                            {{Form::number('order_ACTUAR_L', '', ['class' => 'form-control', 'step'=>'any', 'placeholder' => 'np. 10.5', 'aria-describedby' => 'basic-addon2'])}}
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
                        {{Form::label('order_pp_PERIOD', 'Czas pracy plastyka:')}}
                        <div class="input-group mb-12">
                            @if($errors->has("order_pp_PERIOD")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                            {{Form::number('order_pp_PERIOD', '', ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">godz</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('order_STATUS', 'Status zlecenia:')}}
                @if($errors->has("order_STATUS")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::select('order_STATUS', [0 => 'Nowe', 1 => 'Wydrukowane', 2 => 'Wysłane', 3 => 'Reklamacja'], 0, ['class' => $invalid])}}
            </div>

        </div>
        <div class="col col-lg-4">
            <div class="form-group">
                {{Form::label('order_URL', 'URL podglądu:')}}
                <div class="input-group mb-12">
                    @if($errors->has("order_URL")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::text('order_URL', '', ['class' => $invalid, 'step'=>'any', 'aria-describedby' => 'basic-addon2'])}}
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
                @if($errors->has("order_EFFECTS")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::select('order_EFFECTS', [0 => 'Bez efektu', 1 => 'Czarno-Biały', 2 => 'Sepia', 3 => 'Cold'], 0, ['class' => $invalid])}}
            </div>



            <div class="form-group no-gutter">
                <div class="row">

                    <div class="col-sm no-gutter">
                        {{Form::label('order_ROTATION', 'Obrót')}} &nbsp; <i class="fas fa-undo"></i>
                        @if($errors->has("order_ROTATION")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::select('order_ROTATION', [0 => 'Brak', 90 => '90°', 180 => '180°', 270 => '270°', 360 => '360°'], 0, ['class' => $invalid])}}
                    </div>

                    <div class="col-sm no-gutter">
                        {{Form::label('order_FLIP_X', 'Odbicie poziome')}} &nbsp; <i class="fas fa-arrows-alt-h"></i>
                        @if($errors->has("order_FLIP_X")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::select('order_FLIP_X', ['false' => 'Nie', 'true' => 'Tak'], 0, ['class' => $invalid])}}
                    </div>

                    <div class="col-sm no-gutter">
                        {{Form::label('order_FLIP_Y', 'Odbicie pionowe')}} &nbsp; <i class="fas fa-arrows-alt-v"></i>
                        @if($errors->has("order_FLIP_Y")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::select('order_FLIP_Y', ['false' => 'Nie', 'true' => 'Tak'], 0, ['class' => $invalid])}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('order_OVERLAP', 'Zakładka:')}}
                @if($errors->has("order_OVERLAP")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::select('order_OVERLAP', [0 => 'Brak', 1 => '0,5cm', 2 => '1cm', 3 => 'Inna'], 0, ['class' => $invalid])}}
            </div>

            <div class="form-group">
                {{Form::label('order_LAMINATE', 'Laminat:')}}
                @if($errors->has("order_LAMINATE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::select('order_LAMINATE', [0 => 'Nie', 1 => 'Tak'], 0, ['class' => $invalid])}}
            </div>

            <div class="form-group">
                {{Form::label('order_GLUE', 'Klej:')}}
                @if($errors->has("order_GLUE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::select('order_GLUE', [0 => 'Brak', 1 => 'Metylan Special (lateksowe)', 2 => 'Metylan Direct (winylowe)', 3 => 'Metylan do krawędzi'], 0, ['class' => $invalid])}}
            </div>

            <div class="form-group">
                {{Form::label('order_DESCRIPTION', 'Uwagi do zlecenia:')}}
                {{Form::textarea('order_DESCRIPTION', '', ['class' => $invalid, 'rows' => 5])}}
            </div>

        </div>
    </div>
<br>

    {{-- <div class="row"> KALKULATOR
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
    @endif
</main>
@endsection