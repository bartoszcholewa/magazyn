@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowa koperta</h2>
    <hr>
    @php ($invalid = "form-control")

    {!! Form::open(['action' => 'EnvelopesController@store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col col-lg-4">
            <div class="form-group">
                {{Form::label('envelope_NAME', 'Nazwa:')}}
                @if($errors->has("envelope_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('envelope_NAME', '', ['class' => $invalid, 'placeholder' => 'np. INTER-CAR'])}}
            </div>

            <div class="form-group">
                {{Form::label('envelope_COMPANY', 'Firma:')}}
                @if($errors->has("envelope_COMPANY")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('envelope_COMPANY', '', ['class' => $invalid, 'placeholder' => 'np. INTER-CAR Sp. z o.o.'])}}
            </div>

            <div class="form-group">
                {{Form::label('envelope_PERSON', 'Imię i Nazwisko:')}}
                @if($errors->has("envelope_PERSON")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('envelope_PERSON', '', ['class' => $invalid, 'placeholder' => 'np. Jan Kowalski'])}}
            </div>

            <div class="form-group">
                {{Form::label('envelope_STREET', 'Ulica:')}}
                @if($errors->has("envelope_STREET")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('envelope_STREET', '', ['class' => $invalid, 'placeholder' => 'np. 3 Maja 51/8'])}}
            </div>

            <div class="form-group">
                {{Form::label('envelope_ZIPCODE', 'Kod Pocztowy:')}}
                @if($errors->has("envelope_ZIPCODE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('envelope_ZIPCODE', '', ['class' => $invalid, 'placeholder' => 'np. 52-302'])}}
            </div>

            <div class="form-group">
                {{Form::label('envelope_CITY', 'Miasto:')}}
                @if($errors->has("envelope_CITY")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('envelope_CITY', '', ['class' => $invalid, 'placeholder' => 'np. Wrocław'])}}
            </div>

            <div class="form-group">
                {{Form::label('envelope_COUNTRY', 'Kraj:')}}
                @if($errors->has("envelope_COUNTRY")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('envelope_COUNTRY', 'POLSKA', ['class' => $invalid, 'placeholder' => 'np. POLSKA'])}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-6">
            <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
            {{Form::submit('Dodaj', ['class'=>'btn btn-primary'])}}
        </div>
    </div>
    {!! Form::close() !!}

</main>
@endsection