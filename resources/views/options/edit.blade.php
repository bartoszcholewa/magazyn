@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Ustawienia ogólne: {{ $option->option_NAME}}</h2>
    <hr>
    @php ($invalid = "form-control")  @endphp

    {!! Form::open(['action' => ['OptionsController@update', $option->option_ID], 'method' => 'POST']) !!}

    <div class="row">
        <div class="col col-lg-4 border-right">
            <div class="form-group no-gutter">
                <div class="row">
                    <div class="col-sm no-gutter">
                        {{Form::label('option_NAME', $option->option_NAME)}}
                        <div class="input-group mb-12">
                            {{Form::text('option_VALUE', $option->option_VALUE, ['class' => $invalid])}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('option_AUTOLOAD', 'Autoload:')}}
                {{Form::select('option_AUTOLOAD', ['yes' => 'Tak', 'no' => 'Nie'], $option->option_AUTOLOAD, ['class' => $invalid])}}
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col col-lg-4">
            {{Form::hidden('_method', 'PUT')}}
            <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
            {{Form::submit('Zaktualizuj', ['class'=>'btn btn-primary'])}}

        </div>
    </div>
    {!! Form::close() !!}
</main>
@endsection