@extends('layouts.app')
@section('content')
@include('includes.messages')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="col-md-10">
    <h2>Dostawcy:</h2>
    @if (count($suppliers) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">      
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Adres</th>
                        <th>Telefon</th>
                        <th>Email</th>
                        <th>WWW</th>
                        <th>Przedstawiciel</th>
                        <th>Telefon</th>
                        <th>Email</th>
                    </tr>
                </thead>     
                <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td><a href="/suppliers/{{$supplier->supplier_ID}}">{{$supplier->supplier_NAME}}</td>
                        <td>{{$supplier->supplier_ADDRESS}}</td>
                        <td>{{$supplier->supplier_PHONE}}</td>
                        <td><a href="mailto:{{$supplier->supplier_EMAIL}}">{{$supplier->supplier_EMAIL}}</a></td>
                        <td><a href="{{$supplier->supplier_URL}}">{{$supplier->supplier_URL}}</a></td>
                        <td>{{$supplier->supplier_REP_NAME}}</td>
                        <td>{{$supplier->supplier_REP_PHONE}}</td>
                        <td><a href="mailto:{{$supplier->supplier_REP_EMAIL}}">{{$supplier->supplier_REP_EMAIL}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Brak dodanych dostawców</p>
        @endif
    <a class="btn btn-primary" href="/suppliers/create" role="button">Nowy dostawca</a>
    </div>
</main>
@endsection