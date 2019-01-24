@extends('layouts.app')
@section('content')
@include('includes.messages')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="col-md-8">
    <h2 style="display: inline-block">Rolki: &nbsp;<a class="btn btn-primary btn-sm" href="/rolls/create"><i class="fas fa-plus-circle"></i>  Rolkę</a></h2>
    @if (count($rolls) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">      
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Materiał</th>
                        <th>Data</th>
                        <th>Nr faktury</th>
                        <th>Status rolki</th>
                        <th>Długość aktualna:</th>
                        <th>Ilość zleceń</th>


                    </tr>
                </thead>     
                <tbody>
                @foreach ($rolls as $roll)
                    <tr>
                        <td><a href="/rolls/{{$roll->roll_ID}}">{{$roll->roll_NAME}}</td>
                        <td><a href="/materials/{{$roll->material->material_ID}}">{{$roll->material->material_NAME}}</td>
                        <td>{{$roll->roll_DATE}}</td>
                        <td>{{$roll->roll_INVOICE_NR}}</td>
                        <td>
                            @if($roll->roll_STATUS == 0) Nowa @endif
                            @if($roll->roll_STATUS == 1) W użyciu @endif
                            @if($roll->roll_STATUS == 2) Resztka @endif
                            @if($roll->roll_STATUS == 3) Zakończona @endif
                        </td>
                        <td>{{$roll->roll_LENGTH - $roll->orders->sum('order_EXPECTED_L')}}</td>
                        <td>{{$roll->orders_count}}</td>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Brak dodanych rolek</p>
        @endif
    </div>
</main>
@endsection