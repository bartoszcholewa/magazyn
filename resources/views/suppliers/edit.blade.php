@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Edytuj dostawcę: {{$supplier->supplier_NAME}}</h2>
    <hr>
        {!! Form::open(['action' => ['SuppliersController@update', $supplier->supplier_ID], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group row @if($errors->has("supplier_NAME"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_NAME', 'Nazwa dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-3">
                    {{Form::text('supplier_NAME', $supplier->supplier_NAME, ['class' => 'form-control', 'placeholder' => 'np. Integart'])}}
                </div>
            </div>
            <div class="form-group row @if($errors->has("supplier_ADDRESS"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_ADDRESS', 'Adres dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-3">
                    {{Form::text('supplier_ADDRESS', $supplier->supplier_ADDRESS, ['class' => 'form-control', 'placeholder' => 'np. ul. Sucha 1, 54-515 Wrocław'])}}
                </div>
            </div>
            <div class="form-group row @if($errors->has("supplier_PHONE"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_PHONE', 'Telefon dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-3">
                    {{Form::text('supplier_PHONE', $supplier->supplier_PHONE, ['class' => 'form-control', 'placeholder' => 'np. +48 888 888 888'])}}
                </div>
            </div>
            <div class="form-group row @if($errors->has("supplier_EMAIL"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_EMAIL', 'Email dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-3">
                    {{Form::text('supplier_EMAIL', $supplier->supplier_EMAIL, ['class' => 'form-control', 'placeholder' => 'np. kontakt@dostawca.com'])}}
                </div>
            </div>
            <div class="form-group row @if($errors->has("supplier_URL"))alert alert-danger" role="alert @endif ">
                    {{Form::label('supplier_URL', 'Strona dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::text('supplier_URL', $supplier->supplier_URL, ['class' => 'form-control', 'placeholder' => 'http://www....'])}}
                    </div>
                </div>
            <div class="form-group row @if($errors->has("supplier_DESCRIPTION"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_DESCRIPTION', 'Opis dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-6">
                    {{Form::textarea('supplier_DESCRIPTION', $supplier->supplier_DESCRIPTION, ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="form-group row @if($errors->has("supplier_REP_NAME"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_REP_NAME', 'Nazwa przedstawiciela dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-6">
                    {{Form::text('supplier_REP_NAME', $supplier->supplier_REP_NAME, ['class' => 'form-control', 'placeholder' => 'np. Jan Kowalski'])}}
                </div>
            </div>
            <div class="form-group row @if($errors->has("supplier_REP_PHONE"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_REP_PHONE', 'Telefon przedstawiciela dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-6">
                    {{Form::text('supplier_REP_PHONE', $supplier->supplier_REP_PHONE, ['class' => 'form-control', 'placeholder' => 'np. +48 888 888 888'])}}
                </div>
            </div>
            <div class="form-group row @if($errors->has("supplier_REP_EMAIL"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_REP_EMAIL', 'Email przedstawiciela dostawcy:', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-6">
                    {{Form::text('supplier_REP_EMAIL', $supplier->supplier_REP_EMAIL, ['class' => 'form-control', 'placeholder' => 'jankowalski@dostawca.com'])}}
                </div>
            </div>
            <div class="form-group row @if($errors->has("supplier_LOGO"))alert alert-danger" role="alert @endif ">
                {{Form::label('supplier_LOGO', 'Logo dostawcy', ['class' => 'col-sm-3 col-form-label'])}}
                <div class="col-sm-3">
                    {{Form::file('supplier_LOGO')}}
                </div>
            </div>
            {{Form::hidden('_method', 'PUT')}}
            <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
            {{Form::submit('Zaktualizuj', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
          
</main>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script> 
    CKEDITOR.replace( 'article-ckeditor' );
</script>
@endsection