@extends('layouts.app')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Nowa rolka</h2>
    <hr>
    @php ($invalid = "form-control")
        {!! Form::open(['action' => 'RollsController@store', 'method' => 'POST']) !!}
        <div class="row">
                <div class="col col-lg-4">

                <div class="form-group">
                    {{Form::label('roll_NAME', 'Nazwa rolki:')}}
                    @if($errors->has("roll_NAME")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::text('roll_NAME', '', ['class' => $invalid, 'placeholder' => 'np. Rolka nr 15'])}}
                </div>

                <div class="form-group">
                    {{Form::label('roll_MATERIAL_ID', 'Materiał rolki:')}}  
                    <div class="input-group mb-12">
                        @if($errors->has("roll_MATERIAL_ID")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::select('roll_MATERIAL_ID', $materials, Request::get('material'), ['class' => $invalid, 'placeholder' => 'Wybierz materiał...'])}}
                        <div class="input-group-append">
                            <a class="btn btn-outline-primary" href="/materials/create" role="button">Dodaj</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('roll_DATE', 'Data rolki:')}}                   
                    @if($errors->has("roll_DATE")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::date('roll_DATE', \Carbon\Carbon::today()->format('Y-m-d'), ['class' => $invalid])}}                
                </div>

                <div class="form-group">
                    {{Form::label('roll_STATUS', 'Status rolki:')}}                  
                    @if($errors->has("roll_STATUS")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::select('roll_STATUS', [0 => 'Nowa', 1 => 'W użyciu', 2 => 'Resztka', 3 => 'Zakończona'], 0, ['class' => $invalid])}}                  
                </div>

                <div class="form-group">
                    {{Form::label('roll_DESCRIPTION', 'Opis rolki:')}}            
                    @if($errors->has("roll_DESCRIPTION")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                    {{Form::text('roll_DESCRIPTION', '', ['class' => $invalid, 'placeholder' => 'np. próbka od dostawcy'])}}           
                </div>

                <div class="form-group">
                    {{Form::label('roll_LENGTH', 'Długość niestandardowa:')}}
                    <div class="input-group mb-12">
                        @if($errors->has("roll_LENGTH")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                        {{Form::number('roll_LENGTH', '', ['class' => $invalid, 'placeholder' => 'np. 15.5', 'aria-describedby' => 'basic-addon2', 'step'=>'any'])}}
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2" style="width:64px">mb</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="roll_DEFECTED" value="1" name="roll_DEFECTED">
                        <label class="custom-control-label" for="roll_DEFECTED">Uszkodzona</label>
                    </div>
                </div>

            </div>
            <div class="col col-lg-4">
                <div class="card bg-light">
                    <div class="card-header">
                        Faktura
                    </div>
                    <div class="card-body">
                        <div class="col col-lg-12">
                            <div class="form-group">
                                {{Form::label('roll_INVOICE_NR', 'Numer faktury:')}}   
                                @if($errors->has("roll_INVOICE_NR")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                {{Form::text('roll_INVOICE_NR', '', ['class' => $invalid, 'placeholder' => 'np. FV 1/5/2017'])}}   
                            </div>

                            <div class="form-group">
                                {{Form::label('roll_INVOICE_STATUS', 'Status faktury:')}}
                                @if($errors->has("roll_INVOICE_STATUS")) @php($invalid="form-control is-invalid") @else @php($invalid="form-control") @endif
                                {{Form::select('roll_INVOICE_STATUS', [ 0 => 'Elektronicznie', 1 => 'Listownie', 2 => 'Opłacona', '' => 'Nie dotyczny'], '', ['class' => $invalid])}} 
                            </div>

                            <div class="form-group">
                                {{Form::label('roll_INVOICE_FILE', 'Plik faktury')}}<br>
                                {{Form::file('roll_INVOICE_FILE')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-4">

            <button onclick="goBack()" type="button" class="btn btn-outline-primary">Anuluj</button>
            {{Form::submit('Dodaj', ['class'=>'btn btn-primary'])}}

            </div>
        </div>
        {!! Form::close() !!}
          
</main>
@endsection