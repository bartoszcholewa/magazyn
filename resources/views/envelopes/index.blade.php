@extends('layouts.app')
@section('content')
@include('includes.messages')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="col-md-6">
    <h2 style="display: inline-block">Koperty: &nbsp;<a class="btn btn-primary btn-sm" href="/koperty/create"><i class="fas fa-plus-circle"></i>  Koperte</a></h2>
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
</main>
@endsection