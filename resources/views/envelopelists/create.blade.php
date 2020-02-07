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
    <br>
    ZASTOSUJ VUE plan plastyków!
    <div class="col-md-6">
        @if (count($envelopes) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-sm">      
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa z listy</th>
                            <th>Firma</th>
                            <th>Osoba</th>
                            <th>Adres</th>
                        </tr>
                    </thead>     
                    <tbody>
                    @foreach ($envelopes as $envelope)
                        <tr>
                            <td>{{$envelope->envelope_ID}}</td>
                            <td><a href="/koperty/{{$envelope->envelope_ID}}">{{$envelope->envelope_NAME}}</a></td>
                            <td>{{$envelope->envelope_COMPANY}}</td>
                            <td>{{$envelope->envelope_PERSON}}</td>
                            <td>{{$envelope->envelope_STREET}}
                                <br>{{$envelope->envelope_ZIPCODE}} {{$envelope->envelope_CITY}}
                                <br>{{$envelope->envelope_COUNTRY}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p>Brak dodanych kopert</p>
            @endif
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