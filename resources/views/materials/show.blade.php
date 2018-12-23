                @extends('layouts.app')

                @section('content')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    
                    <h2>{{$material->material_NAME}}</h2>
                    <hr>
                    <p>Dostawca: {{$material->material_SUPPLIER}}<br>
                    Szerokość: {{$material->material_WIDTH}}cm<br>
                    Długość: {{$material->material_LENGTH}}m<br>
                    Gramatura: {{$material->material_GSQM}}g/m<sup>2</sup></p>

                    <hr>
                    <small>Dodano {{$material->created_at}}<small>
                    {!!Form::open(['action' => ['MaterialsController@destroy', $material->material_ID], 'method' => 'POST'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        <p><button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
                        <a class="btn btn-primary btn-sm" href="/materials/{{$material->material_ID}}/edit" role="button">Edytuj</a>
                        {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Are you sure?")'])}}</p>
                    {!!Form::close()!!}
                </main>
                @endsection