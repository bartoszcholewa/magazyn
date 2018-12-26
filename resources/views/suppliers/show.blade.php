@extends('layouts.app')

@section('content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="col-md-6">
        @include('includes.messages')
            <div class="row">
                <div class="col-sm-8">
                    <h2>{{$supplier->supplier_NAME}}</h2>
                    @if(!Auth::guest())
                        {!!Form::open(['action' => ['SuppliersController@destroy', $supplier->supplier_ID], 'method' => 'POST'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                    @endif
                    <button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
                    <a class="btn btn-outline-primary btn-sm" target="_blank" href="{{$supplier->supplier_URL}}" role="button">Strona dostawcy</a>
                    @if(!Auth::guest())
                        <a class="btn btn-primary btn-sm" href="/suppliers/{{$supplier->supplier_ID}}/edit" role="button">Edytuj</a>
                        {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Are you sure?")'])}}
                        {!!Form::close()!!}
                    @endif
                </div>
                @if($supplier->supplier_LOGO !== 'nologo.jpg')
                    <div class="col align-self-end">
                    <a href="{{$supplier->supplier_URL}}"><img src="/storage/supplier_LOGO/{{$supplier->supplier_LOGO}}" class="img-responsive img-fluid" alt="Integart – media do druku wielkoformatowego, drukarki latexowe i UV"></a>
                    </div>
                @endif
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <p>Adres: {{$supplier->supplier_ADDRESS}}<br>
                    Telefon: {{$supplier->supplier_PHONE}}<br>
                    Email: <a href="mailto:{{$supplier->supplier_EMAIL}}">{{$supplier->supplier_EMAIL}}</a><br>
                    WWW: <a href="{{$supplier->supplier_URL}}">{{$supplier->supplier_URL}}</a><br></p>
                </div>
                <div class="col-sm-6">
                    <p>Przedstawiciel: {{$supplier->supplier_REP_NAME}}<br>
                    Telefon: {{$supplier->supplier_REP_PHONE}}<br>
                    Email: <a href="mailto:{{$supplier->supplier_REP_EMAIL}}">{{$supplier->supplier_REP_EMAIL}}</a></p>
                </div>
            </div>
            @if($supplier->supplier_DESCRIPTION !== NULL)
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-secondary mb-12">
                        <div class="card-header">Opis dostawcy</div>
                        <div class="card-body text-secondary">
                            <p class="card-text">{!!$supplier->supplier_DESCRIPTION!!}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <hr>
                    <small>Dodano {{$supplier->created_at}} przez {{$supplier->creator->name}} | Edytowano {{$supplier->updated_at}} przez {{$supplier->editor->name}}</small>
                    <hr>
                </div>
            </div>
        </div>
    </main>
@endsection