@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowy dostawca</h2>
    <hr>
    @php ($invalid = "form-control")
        {!! Form::open(['action' => 'SuppliersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col col-lg-4">
                    <div class="form-group">
                        {{Form::label('supplier_NAME', 'Nazwa:')}}
                        @if($errors->has("supplier_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('supplier_NAME', '', ['class' => $invalid, 'placeholder' => 'np. Integart'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('supplier_ADDRESS', 'Adres:')}}
                        @if($errors->has("supplier_ADDRESS")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('supplier_ADDRESS', '', ['class' => $invalid, 'placeholder' => 'np. ul. Sucha 1, 54-515 Wrocław'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('supplier_PHONE', 'Telefon:')}}
                        @if($errors->has("supplier_PHONE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('supplier_PHONE', '', ['class' => $invalid, 'placeholder' => 'np. +48 888 888 888'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('supplier_EMAIL', 'Email:')}}
                        @if($errors->has("supplier_EMAIL")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('supplier_EMAIL', '', ['class' => $invalid, 'placeholder' => 'np. kontakt@dostawca.com'])}}
                    </div>

                    <div class="card bg-light">
                        <div class="card-header">
                            Przedstawiciel
                        </div>
                        <div class="card-body">
                            <div class="col">
                                <div class="form-group">
                                    {{Form::label('supplier_REP_NAME', 'Imię i Nazwisko:')}}
                                    @if($errors->has("supplier_REP_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                    {{Form::text('supplier_REP_NAME', '', ['class' => $invalid, 'placeholder' => 'np. Jan Kowalski'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('supplier_REP_PHONE', 'Telefon:')}}
                                    @if($errors->has("supplier_REP_PHONE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                    {{Form::text('supplier_REP_PHONE', '', ['class' => $invalid, 'placeholder' => 'np. +48 888 888 888'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('supplier_REP_EMAIL', 'Email:')}}
                                    @if($errors->has("supplier_REP_EMAIL")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                    {{Form::text('supplier_REP_EMAIL', '', ['class' => $invalid, 'placeholder' => 'jankowalski@dostawca.com'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-6">
                    <div class="form-group">
                        {{Form::label('supplier_DESCRIPTION', 'Opis:')}}
                        @if($errors->has("supplier_DESCRIPTION")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::textarea('supplier_DESCRIPTION', '', ['id' => 'article-ckeditor', 'class' => $invalid])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('supplier_URL', 'Strona WWW:')}}
                        @if($errors->has("supplier_URL")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::text('supplier_URL', '', ['class' => $invalid, 'placeholder' => 'http://www....'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('supplier_LOGO', 'Logo:')}}<br>
                        {{Form::file('supplier_LOGO')}}
                    </div>
                </div>
            </div><br>
            
            <div class="row">
                    <div class="col col-lg-6">
                    <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
                    {{Form::submit('Dodaj', ['class'=>'btn btn-primary'])}}
                </div>
            </div>
        {!! Form::close() !!}
</main>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script> 
    CKEDITOR.replace( 'article-ckeditor' );
</script>
@endsection