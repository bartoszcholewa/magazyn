@extends('layouts.app')
@section('content')
@include('includes.messages')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="col-md-3">
    <h2 style="display: inline-block">Lista kopert: &nbsp;<a class="btn btn-primary btn-sm" href="/kopertylista/create"><i class="fas fa-plus-circle"></i>  Liste kopert</a></h2>
    @if (count($envelopelists) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">      
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nazwa listy</th>

                    </tr>
                </thead>     
                <tbody>
                @foreach ($envelopelists as $envelopelist)
                    <tr>
                        <td>{{$envelopelist->envelopelist_ID}}</td>
                        <td><a href="/kopertylista/{{$envelopelist->envelopelist_ID}}">{{$envelopelist->envelopelist_NAME}}</a><br>
                            {{-- @foreach ($envelopelist->packets->sortBy('envelopepacket_ORDER') as $envelopepacket)
                                - {{$envelopepacket->envelope->envelope_NAME}}<br>
                            @endforeach --}}
                        </td>
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