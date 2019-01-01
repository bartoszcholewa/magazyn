@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowy materiał</h2>
    <hr>
    @php ($invalid = "form-control")

    {!! Form::open(['action' => 'MaterialsController@store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col col-lg-4">

            <div class="form-group">
                {{Form::label('material_NAME', 'Nazwa:')}}
                @if($errors->has("material_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('material_NAME', '', ['class' => $invalid, 'placeholder' => 'np. Latex Premium'])}}
            </div>

            <div class="form-group">
                {{Form::label('material_SUPPLIER', 'Dostawca:')}}
                <div class="input-group mb-12">
                    @if($errors->has("material_SUPPLIER")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::select('material_SUPPLIER', $suppliers, null, ['class' => $invalid, 'placeholder' => 'Wybierz dostawcę...'])}}
                    <div class="input-group-append">
                        <a class="btn btn-outline-primary" href="/suppliers/create" role="button">Dodaj</a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('material_WIDTH', 'Szerokość:')}}
                <div class="input-group mb-12">
                    @if($errors->has("material_WIDTH")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::number('material_WIDTH', '', ['class' => $invalid, 'placeholder' => 'np. 137.2', 'aria-describedby' => 'basic-addon2', 'step'=>'any'])}}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2" style="width:64px">cm</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('material_LENGTH', 'Długość:')}}
                <div class="input-group mb-12">
                    @if($errors->has("material_LENGTH")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::number('material_LENGTH', '', ['class' => $invalid, 'placeholder' => 'np. 50.5', 'aria-describedby' => 'basic-addon2', 'step'=>'any'])}}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2" style="width:64px">m</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('material_GSQM', 'Gramatura:')}}
                <div class="input-group mb-12">
                    @if($errors->has("material_GSQM")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::number('material_GSQM', '', ['class' => $invalid, 'placeholder' => 'np. 200', 'aria-describedby' => 'basic-addon2', 'step'=>'any'])}}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2" style="width:64px">g/m<sup>2</sup></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{Form::label('material_URL', 'Strona produktu:')}}
                @if($errors->has("material_URL")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::text('material_URL', '', ['class' => $invalid, 'placeholder' => 'http://www...'])}}
            </div>
        </div>

        <div class="col col-lg-6">
            <div class="form-group">
                {{Form::label('material_DESCRIPTION', 'Opis:')}}
                @if($errors->has("material_DESCRIPTION")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                {{Form::textarea('material_DESCRIPTION', '', ['id' => 'article-ckeditor', 'class' => $invalid])}}
            </div>
        </div>
    </div>
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