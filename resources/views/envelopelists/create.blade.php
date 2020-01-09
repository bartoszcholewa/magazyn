@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowa lista kopert</h2>
    <hr>
    @php ($invalid = "form-control")

    {!! Form::open(['action' => 'EnvelopelistsController@store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col col-lg-4">
            <div class="form-group">
                {{Form::label('envelopelist_NAME', 'Nazwa listy:')}}
                @if($errors->has("envelopelist_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('envelopelist_NAME', '', ['class' => $invalid, 'placeholder' => 'np. STYCZEŃ 2020'])}}
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