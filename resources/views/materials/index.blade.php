@extends('layouts.app')
@section('content')
@include('includes.messages')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="col-md-8">
    <h2 style="display: inline-block">Materiały: &nbsp;<a class="btn btn-primary btn-sm" href="/materials/create"><i class="fas fa-plus-circle"></i>  Materiał</a></h2>
    @if (count($materials) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">      
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Dostawca</th>
                        <th>Szerokość (cm)</th>
                        <th>Długość (mb)</th>
                        <th>Gramatura (g/m<sup>2</sup>)</th>
                    </tr>
                </thead>     
                <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td><a href="/materials/{{$material->material_ID}}">{{$material->material_NAME}}</td>
                        <td>{{$material->supplier->supplier_NAME}}</td>
                        <td>{{$material->material_WIDTH}}</td>
                        <td>{{$material->material_LENGTH}}</td>
                        <td>{{$material->material_GSQM}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Brak dodanych materiałów</p>
        @endif
    </div>
</main>
@endsection