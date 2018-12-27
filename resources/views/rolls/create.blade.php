@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowa rolka</h2>
    <hr>

        {!! Form::open(['action' => 'RollsController@store', 'method' => 'POST']) !!}
                <div class="form-group row @if($errors->has("roll_NAME"))alert alert-danger" role="alert @endif ">
                    {{Form::label('roll_NAME', 'Nazwa rolki:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::text('roll_NAME', '', ['class' => 'form-control', 'placeholder' => 'np. Rolka nr 15'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("roll_MATERIAL_ID"))alert alert-danger" role="alert @endif ">
                    {{Form::label('roll_MATERIAL_ID', 'Materiał rolki:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::select('roll_MATERIAL_ID', $materials, null, ['class' => 'form-control', 'placeholder' => 'Wybierz materiał...'])}}
                    </div>
                    <div class="col-sm-4 col-md-offset-3">
                        <a href="/materials/create">[Dodaj]</a>
                    </div>
                </div>
                <div class="form-group row @if($errors->has("roll_DATE"))alert alert-danger" role="alert @endif ">
                    {{Form::label('roll_DATE', 'Data rolki:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::date('roll_DATE', \Carbon\Carbon::today()->format('Y-m-d'), ['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("roll_STATUS"))alert alert-danger" role="alert @endif ">
                    {{Form::label('roll_STATUS', 'Status rolki:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::select('roll_STATUS', [0 => 'Nowa', 1 => 'W użyciu', 2 => 'Resztka', 3 => 'Zakończona'], 0, ['class' => 'form-control'])}}
                    </div>
                </div>
                <hr>
                <div class="form-group row @if($errors->has("roll_DESCRIPTION"))alert alert-danger" role="alert @endif ">
                        {{Form::label('roll_DESCRIPTION', 'Opis rolki:', ['class' => 'col-sm-3 col-form-label'])}}
                        <div class="col-sm-3">
                            {{Form::text('roll_DESCRIPTION', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                <div class="form-group row @if($errors->has("roll_LENGTH"))alert alert-danger" role="alert @endif ">
                        {{Form::label('roll_LENGTH', 'Długość niestandardowa', ['class' => 'col-sm-3 col-form-label'])}}
                        <div class="col-sm-3">
                            {{Form::number('roll_LENGTH', '', ['class' => 'form-control', 'placeholder' => 'np. 40.5', 'step'=>'any'])}}
                        </div>
                    </div>
                <div class="form-group row @if($errors->has("roll_DEFECTED"))alert alert-danger" role="alert @endif ">
                    {{Form::label('roll_DEFECTED', 'Uszkodzona:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::checkbox('roll_DEFECTED', 1)}}
                    </div>
                </div>
                <hr>
                <div class="form-group row @if($errors->has("roll_INVOICE_NR"))alert alert-danger" role="alert @endif ">
                    {{Form::label('roll_INVOICE_NR', 'Numer faktury:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::text('roll_INVOICE_NR', '', ['class' => 'form-control', 'placeholder' => 'np. FV 1/5/2017'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("roll_INVOICE_FILE"))alert alert-danger" role="alert @endif ">
                    {{Form::label('roll_INVOICE_FILE', 'Plik faktury:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::text('roll_INVOICE_FILE', '', ['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="form-group row @if($errors->has("roll_INVOICE_STATUS"))alert alert-danger" role="alert @endif ">
                    {{Form::label('roll_INVOICE_STATUS', 'Status faktury:', ['class' => 'col-sm-3 col-form-label'])}}
                    <div class="col-sm-3">
                        {{Form::select('roll_INVOICE_STATUS', [ 0 => 'Elektronicznie', 1 => 'Listownie', 2 => 'Opłacona', '' => 'Nie dotyczny'], '', ['class' => 'form-control'])}}
                    </div>
                </div>
            {{Form::submit('Dodaj', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
          
</main>
@endsection