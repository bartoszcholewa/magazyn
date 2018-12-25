                @extends('layouts.app')

                @section('content')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <div class="col-md-8">
                    <h2>Materiały:</h2>
                    @include('includes.messages')
                    @if (count($materials) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">      
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nazwa</th>
                                        <th>Dostawca</th>
                                        <th>Szerokość (cm)</th>
                                        <th>Długość (mb)</th>
                                        <th>Gramatura (g/m<sup>2</sup>)</th>
                                    </tr>
                                </thead>     
                                <tbody>
                                @foreach ($materials as $material)
                                    <tr>
                                        <td>{{$material->material_ID}}</td>
                                        <td><a href="/materials/{{$material->material_ID}}">{{$material->material_NAME}}</td>
                                        <td>{{$material->material_SUPPLIER}}</td>
                                        <td>{{$material->material_WIDTH}}</td>
                                        <td>{{$material->material_LENGTH}}</td>
                                        <td>{{$material->material_GSQM}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p>Brak dodanych materiałów</p>
                        @endif
                    <a class="btn btn-primary" href="/materials/create" role="button">Nowy materiał</a>
                    </div>
                </main>
                @endsection