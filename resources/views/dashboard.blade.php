@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>Nazwa</th>
                        <th>Nazwa1</th>
                        <th>Nazwa2</th>
                    </tr>
                    @foreach ($materials_creator as $material)
                        <tr>
                            <td>{{$material->material_NAME}}</td>
                            <td>Nazwa1</td>
                            <td>Nazwa2</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
