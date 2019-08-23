@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
    @if($order->order_NAME == "0")
        <div class="row col-sm-12">
            <h2><b>Kalibracja Maszyny</h2>
        </div>
        <div class="row col-sm-12 mr-5">
            <table class="table col-sm-4 mr-5">
                <tbody>
                    <tr>
                        <th>Materiał/Rolka:</th>
                        <td>{{$order->material->material_NAME}} - {{$order->roll->roll_NAME}}</td>
                    </tr>
                    <tr>
                        <th>Długość kalibracji:</th>
                        <td>{{$order->order_ACTUAR_L}}mb</td>
                    </tr>
                    <tr>
                        <th>Data:</th>
                        <td>{{$order->created_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="row col-sm-12">
            <h2><b>PW-{{$order->order_NAME}}</b> @if($order->order_QUANTITY > 1) ({{$order->order_QUANTITY}} szt.) @endif - {{$order->order_CLIENT_NAME}} {{$order->order_CLIENT_SURNAME}}</h2>
        </div>
        <div class="row col-sm-12">
            <table class="table col-sm-4 mr-5">
                <tbody>
                    <tr>
                        <th>Materiał/Rolka:</th>
                        <td>{{$order->material->material_NAME}} @if($order->order_ROLL_ID != NULL)  - {{$order->roll->roll_NAME}} @endif</td>
                    </tr>
                    <tr>
                        <th>Długość zlecenia:</th>
                        <td>@if($order->order_ACTUAR_L != NULL) {{$order->order_ACTUAR_L}} @else {{ $order->order_SAFE_L}} @endif mb</td>
                    </tr>
                    <tr>
                        <th>Czas w obiegu:</th>
                        <td>{{ $diff = Carbon\Carbon::parse($order->created_at)->diffForHumans(Carbon\Carbon::now(), true) }}</td>
                    </tr>
                    <tr>
                        <th>Data wejścia zlecenia:</th>
                        <td>{{$order->order_DATE}}</td>
                    </tr>
                    <tr>
                        <th>Data pocięcia:</th>
                        <td>{{$order->order_CUTDATE}}</td>
                    </tr>
                    <tr>
                        <th>Czas pracy plastyka:</th>
                        <td>{{$order->order_pp_PERIOD}} godz</td>
                    </tr>
                    {{--@if($order->order_STATUS == "1") <tr class="table-success"> @else <tr> @endif
                        <th>Status:</th>
                        <td class="row wydrukowane">@if($order->order_STATUS == 0) Nowe &nbsp;
                            {!!Form::open(['action' => ['OrdersController@wydrukowane', $order->order_ID], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'PATCH')}}
                            {{Form::submit('Print', ['class' => 'btn btn-success btn-sm print', 'onclick' => 'return confirm("Czy na pewno?")'])}}
                            {!!Form::close()!!} @endif
                            @if($order->order_STATUS == 1) Wydrukowane @endif
                            @if($order->order_STATUS == 2) Wysłane @endif
                            @if($order->order_STATUS == 3) Reklamacja @endif</td>
                    </tr> --}}
                    <tr>
                        <th>Status:</th>
                            @if(!isset($order->order_VERIFIED)) <td>Nowe <a class="btn btn-primary btn-sm" href="/orders/{{$order->order_ID}}/verified" role="button">Zatwiedź</a></td>
                            @elseif(!isset($order->order_PRINTED)) <td>Zatwiedzone <a class="btn btn-primary btn-sm" href="/orders/{{$order->order_ID}}/printed" role="button">Wydrukuj</a></td>
                            @elseif(!isset($order->order_FINISHED)) <td>Wydrukowane <a class="btn btn-primary btn-sm" href="/orders/{{$order->order_ID}}/finished" role="button">Zakończ</a></td>
                            @elseif(isset($order->order_FINISHED)) <td>Zakończone</td>
                            @endif
                    </tr>
                    <tr>
                        <th>Uwagi:</th>
                        <td>{{$order->order_DESCRIPTION}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table col-sm-4">
                <tbody>
                    <tr>
                        <th>URL podglądu:</th>
                        <td>@if($order->order_URL !== NULL) <a href="{{$order->order_URL}}" target="_blank"><i class="fas fa-external-link-alt"></i> Podgląd</a>@endif </td>
                    </tr>
                    <tr>
                        <th>Efekty:</th>
                        <td>@if($order->order_EFFECTS == 0) Bez efektu
                            @elseif($order->order_EFFECTS == 1) Czarno-Biały
                            @elseif($order->order_EFFECTS == 2) Sepia
                            @elseif($order->order_EFFECTS == 3) Cold @endif</td>
                    </tr>
                    <tr>
                        <th>Obrót&nbsp;<i class="fas fa-undo"></i>:</th>
                        <td>@if($order->order_ROTATION == 0) Brak
                                @elseif($order->order_ROTATION == 90) 90°
                                @elseif($order->order_ROTATION == 180) 180°
                                @elseif($order->order_ROTATION == 270) 270° 
                                @elseif($order->order_ROTATION == 360) 360° @endif</td>
                    </tr>
                    <tr>
                        <th>Odbicie poziome&nbsp; <i class="fas fa-arrows-alt-h"></i>:</th>
                        <td>@if($order->order_FLIP_X == 'false') Nie
                            @elseif($order->order_FLIP_X == 'true') Tak @endif</td>
                    </tr>
                    <tr>
                        <th>Odbicie pionowe&nbsp; <i class="fas fa-arrows-alt-v"></i>:</th>
                        <td>@if($order->order_FLIP_Y == 'false') Nie
                                @elseif($order->order_FLIP_Y == 'true') Tak @endif</td>
                    </tr>
                    <tr>
                        <th>Zakładka:</th>
                        <td>@if($order->order_OVERLAP == 0) Brak
                                @elseif($order->order_OVERLAP == 1) 0,5cm
                                @elseif($order->order_OVERLAP == 2) 1cm
                                @elseif($order->order_OVERLAP == 3) Inna @endif</td>
                    </tr>
                    <tr>
                        <th>Laminat:</th>
                        <td>@if($order->order_LAMINATE == 0) Nie
                                @elseif($order->order_LAMINATE == 1) Tak @endif</td>
                    </tr>
                    <tr>
                        <th>Klej:</th>
                        <td>@if($order->order_GLUE == 0) Brak
                                @elseif($order->order_GLUE == 1) Metylan Special (lateksowe)
                                @elseif($order->order_GLUE == 2) Metylan Direct (winylowe)
                                @elseif($order->order_GLUE == 3) Metylan do krawędzi @endif</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if(isset($order->order_URL))
            <div class="row">
                <div style="float:left" class="ml-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $img_url_500 }}" data-toggle="modal" data-target="#myModal">
                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <img src="{{ $img_url_1000 }}" class="img-responsive">
                            </div>
                        </div>
                            
                        <div class="card-footer text-muted">
                            Podgląd fototapety
                        </div>
                    </div>
                </div>

                {{-- <div class="col-sm-8">
                    <table class="table col-sm-4">
                        <tbody>
                            <tr>
                                <th>Wymiar grafiki:</th>
                                <td>TODO</td>
                            </tr>
                            <tr>
                                <th>Wymiar kadru</th>
                                <td>{{$order_json['w']}}cm x {{$order_json['h']}}cm</td>
                            </tr>
                            <tr>
                                <th>Ilość sztuk:</th>
                                <td>{{$order_json['szt']}} szt.</td>
                            </tr>
                            <tr>
                                <th>Cena: (czemu zła?)</th>
                                <td>{{$order_json['cena']}} zł</td>
                            </tr>
                            <tr>
                                <th>Przesunięcie kadru</th>
                                <td><i class="fas fa-arrow-right"></i> {{$order_json['x']}}cm, <i class="fas fa-arrow-down"></i> {{$order_json['y']}}cm</td>
                            </tr>
                            <tr>
                                <th>Ilość brytów:</th>
                                <td>{{count($order_json['crop'])}}</td>
                            </tr>
                            <tr>
                                <th>Takie same bryty?</th>
                                <td>@if(isset($order_json['multi_crop'])) Nie @else Tak @endif</td>
                            </tr>
                            <tr>
                                <th>Wymiary brytów:</th>
                                <td> @php $nr_brytu = "0" @endphp
                                @foreach ($order_json['crop'] as $bryt)
                                    B{{++$nr_brytu}} - {{$order_json['w'] / count($order_json['crop'])}}cm x {{$order_json['h']}}cm <br>
                                @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}
            </div>
        @endif

        
    <hr>
    @endif
    <div class="row">
        <div class="col-sm-6">
            @if(!Auth::guest())
                {!!Form::open(['action' => ['OrdersController@destroy', $order->order_ID], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
            @endif
            <button onclick="goBack()" type="button" class="btn btn-outline-primary btn-sm">Wróć</button>
            @if(!Auth::guest())
                <a class="btn btn-primary btn-sm" href="/orders/{{$order->order_ID}}/edit" role="button">Edytuj</a>
                {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Czy napewno chcesz usunąć?")'])}}
                {!!Form::close()!!}
            @endif
        </div>
    </div>
    <br>
    <small>Dodano {{$order->created_at}} przez {{$order->creator->name}}<br>Edytowano {{$order->updated_at}} przez {{$order->editor->name}}</small><br>

</main>
@endsection