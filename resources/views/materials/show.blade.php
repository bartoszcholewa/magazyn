                @extends('layouts.app')
                @include('includes.messages')
                @section('content')
                <main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
                    <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-8">
                        <h2>{{$material->material_NAME}}</h2><small>Dodano {{$material->created_at}} przez {{$material->creator->name}}</small> | 
                        <small>Edytowano {{$material->updated_at}} przez {{$material->editor->name}}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            @if(!Auth::guest())
                                {!!Form::open(['action' => ['MaterialsController@destroy', $material->material_ID], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                            @endif
                            <button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
                            <a class="btn btn-outline-primary btn-sm" target="_blank" href="{{$material->material_URL}}" role="button">Idź do sklepu</a>
                            @if(!Auth::guest())
                                <a class="btn btn-primary btn-sm" href="/materials/{{$material->material_ID}}/edit" role="button">Edytuj</a>
                                <a class="btn btn-primary btn-sm" href="/materials/{{$material->material_ID}}/raport" role="button">Raport</a>
                                {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Czy napewno chcesz usunąć?")'])}}
                                {!!Form::close()!!}
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>Dostawca: {{$material->supplier->supplier_NAME}}<br>
                            Szerokość: {{$material->material_WIDTH}}cm<br>
                            Długość: {{$material->material_LENGTH}}m<br>
                            Gramatura: {{$material->material_GSQM}}g/m<sup>2</sup></p>
                        </div>
                    </div>
                    @if($material->material_DESCRIPTION !== NULL)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card border-secondary mb-6" style="max-width: 50rem;">
                                <div class="card-header">Opis materiału</div>
                                <div class="card-body text-secondary">
                                    <p class="card-text">{!!$material->material_DESCRIPTION!!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    </div>
                </main>
                @endsection