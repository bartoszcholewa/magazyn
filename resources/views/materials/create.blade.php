@extends('layouts.app')

@section('content')
<!-- materials/index.blade.php START -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowy materiał</h2>
    <hr>
        {!! Form::open(['action' => 'MaterialsController@store', 'method' => 'POST']) !!}
                <div class="form-group row @if($errors->has("material_NAME"))alert alert-danger" role="alert @endif ">
                    {{Form::label('material_NAME', 'Nazwa materiału:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::text('material_NAME', '', ['class' => 'form-control', 'placeholder' => 'np. Latex Premium'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("material_SUPPLIER"))alert alert-danger" role="alert @endif ">
                    {{Form::label('material_SUPPLIER', 'Dostawca materiału:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::select('material_SUPPLIER', ['Igepa' => 'Igepa', 'Integart' => 'Integart', 'Lambda' => 'Lambda', 'Cefol' => 'Cefol'], null, ['class' => 'form-control', 'placeholder' => 'Wybierz dostawcę...'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("material_WIDTH"))alert alert-danger" role="alert @endif ">
                    {{Form::label('material_WIDTH', 'Szerokość materiału (cm):', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::number('material_WIDTH', '', ['class' => 'form-control', 'placeholder' => 'np. 137.2', 'step'=>'any'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("material_LENGTH"))alert alert-danger" role="alert @endif ">
                    {{Form::label('material_LENGTH', 'Długość materiału (m):', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::number('material_LENGTH', '', ['class' => 'form-control', 'placeholder' => 'np. 50.5', 'step'=>'any'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("material_GSQM"))alert alert-danger" role="alert @endif ">
                    {{Form::label('material_GSQM', 'Gramatura materiału (g/m2):', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::number('material_GSQM', '', ['class' => 'form-control', 'placeholder' => 'np. 200', 'step'=>'any'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("material_DESCRIPTION"))alert alert-danger" role="alert @endif ">
                    {{Form::label('material_DESCRIPTION', 'Opis materiału:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-6">
                        {{Form::textarea('material_DESCRIPTION', ' 1', ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("material_URL"))alert alert-danger" role="alert @endif ">
                    {{Form::label('material_URL', 'URL materiału:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-6">
                        {{Form::text('material_URL', '', ['class' => 'form-control', 'placeholder' => 'http://www...'])}}
                    </div>
                </div>
            {{Form::submit('Dodaj', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
          
</main>
<!-- materials/index.blade.php STOP -->
@endsection