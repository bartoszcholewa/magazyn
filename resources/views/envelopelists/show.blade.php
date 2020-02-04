@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="col-md-8">
        <div class="row">
            <div class="col-sm-8">
            <h2>{{$envelopelist->envelopelist_NAME}}</h2><small>Dodano {{$envelopelist->created_at}} | 
            Edytowano {{$envelopelist->updated_at}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @if(!Auth::guest())
                    {!!Form::open(['action' => ['EnvelopelistsController@destroy', $envelopelist->envelopelist_ID], 'method' => 'POST'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                @endif
                <button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
                @if(!Auth::guest())
                    <a class="btn btn-primary btn-sm" href="/kopertylista/{{$envelopelist->envelopelist_ID}}/edit" role="button">Edytuj</a>
                    {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Czy napewno chcesz usunąć?")'])}}
                    {!!Form::close()!!}
                @endif
            </div>
        </div>
        <br>
        {{-- <div class="row">
            <div class="col-sm-6">
                <tbody>
                Nazwa listy: {{$envelopelist->envelopelist_NAME}}<hr>
                
                        @foreach ($envelopelist->packets->sortBy('envelopepacket_ORDER') as $envelopepacket)
                        <tr>
                            <td>{{$envelopepacket->envelope->envelope_NAME}}</td>
                        </tr>
                        @endforeach
                
                </tbody>
            </div>
        </div> --}}
        <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-striped table-sm">      
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa koperty</th>
                            <th>Kolejność</th>
                        </tr>
                    </thead>     
                    <tbody>
                    @foreach ($envelopelist->packets->sortBy('envelopepacket_ORDER') as $envelopepacket)
                        <tr>
                            <td>{{$envelopepacket->envelope->envelope_ID}}</td>
                            <td><a href="/kopertylista/{{$envelopepacket->envelope->envelope_ID}}">{{$envelopepacket->envelope->envelope_NAME}}</a></td>
                            <td>{{$envelopepacket->envelopepacket_ORDER}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a class="btn btn-primary btn-sm" href="/kopertylista/{{$envelopelist->envelopelist_ID}}/pdf" role="button">Pobierz PDF</a>
        </div>
    </div>
</main>
@endsection