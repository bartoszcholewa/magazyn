@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <p>Materiały:</p>
    @if(count($materials) > 0)
        <ul class='list-group'>
            @foreach($materials as $material)
                <li class='list-group-item'>{{$material}}</li>
            @endforeach
        </ul>
    @endif
@endsection
