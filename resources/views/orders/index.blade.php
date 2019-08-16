@extends('layouts.app')
@section('content')
@include('includes.messages')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">  
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5 p-2">
                <h2 style="display: inline-block">Zlecenia: &nbsp;  
                    <a class="btn btn-primary btn-sm" href="/orders/create" role="button">
                        <i class="fas fa-plus-circle"></i> Zlecenie
                    </a>
                </h2>
            </div>

            {{-- SEARCH BOX --}}
            <div class="col-3 p-2">
                <div class="input-group row">
                  <input type="text" class="form-control" placeholder="Wyszukaj..." id="address" onkeypress="handle(event)">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="button" id="search" onClick="search_func()" value="search">
                        <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
            </div>

            {{-- FILTER BOX --}}
            <div class="col-3 p-2">
                <div class="input-group row">
                    <label for="filter" class="col-sm-2 col-form-label">Filtry:</label>
                    <select class="form-control" id="filter" onchange="location = this.value;">
                        <option value="orders">Wszystko</option>
                        <option value="?laminate=1" {{ Request::has('laminate') ? 'selected="selected"' : null }}>Laminacja</option>
                        <option value="?complaint=1" {{ Request::has('complaint') ? 'selected="selected"' : null }}>Reklamacja</option>
                    </select>
                </div>
            </div>
            <div class="col-1 p-2">
                <a class="btn btn-outline-primary btn-sm" href="/orders" role="button">RESET</a>
            </div>


        </div>
        @if (count($orders) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-sm table-hover">      
                    <thead>
                        <tr>
                            <th>Nazwa zlecenia</th>
                            <th>Klient</th>
                            <th>Materiał</th>
                            <th>Rolka</th>
                            <th>Podgląd</th>
                            <th>Utworzył</th>
                            <th>Czas w obiegu</th>
                            <th>Zatwierdzone</th>
                            <th>Wydrukowane</th>
                            <th>Wysłane</th>
                        </tr>
                    </thead>     
                    <tbody>
                    @foreach ($orders as $order)
                        @if($order->order_NAME == "0") @else
                            <tr class='clickable-row' data-href='/orders/{{$order->order_ID}}'>
                                <td>
                                    <a href="/orders/{{$order->order_ID}}">PW-{{$order->order_NAME}}  
                                    @if($order->order_LAMINATE == 1) 
                                        <i class="fas fa-paint-roller ml-1 mr-1" title="Laminacja"></i> 
                                    @endif
                                    @if($order->order_QUANTITY > 1)
                                        <b>({{$order->order_QUANTITY}} szt.)</b>
                                    @endif
                                </td>
                                <td>{{$order->order_CLIENT_NAME}} {{$order->order_CLIENT_SURNAME}}</td>
                                {{-- <td>@if($order->order_MATERIAL_ID == NULL) Brak @else @if(!$order->material()->exists()) Usunięty @else {{$order->material->material_NAME}} @endif @endif</td>
                                <td>@if($order->order_ROLL_ID == NULL) Brak @else @if(!$order->roll()->exists()) Usunięty @else {{$order->roll->roll_NAME}} @endif @endif</td> --}}
                                <td>{{$order->material->material_NAME}}</td>
                                <td>{{$order->roll->roll_NAME}}</td>
                                <td>@if($order->order_URL !== NULL) <a href="{{$order->order_URL}}" target="_blank"><i class="fas fa-external-link-alt"></i></a>@endif </td>
                                <td>{{$order->creator->name}}</td>
                                <td>
                                    {{ $diff = Carbon\Carbon::parse($order->created_at)->diffForHumans(Carbon\Carbon::now(), true) }}
                                </td>
                                <td>
                                    @if(isset($order->order_VERIFIED)) <i class="fas fa-check-circle" style="color:limegreen" title="Zatwierdzone"></i> @else <i class="far fa-circle" style="color:grey" title="Niezatwierdzone"></i> @endif
                                </td>
                                {{--<td>
                                    @if($order->order_STATUS == 0) Nowe @endif
                                    @if($order->order_STATUS == 1) Wydrukowane @endif
                                    @if($order->order_STATUS == 2) Wysłane @endif
                                    @if($order->order_STATUS == 3) Reklamacja @endif
                                </td> --}}
                                <td>
                                    @if(isset($order->order_PRINTED)) <i class="fas fa-check-circle" style="color:limegreen" title="Wydrukowane"></i> @else <i class="far fa-circle" style="color:grey" title="Niewydrukowane"></i> @endif
                                </td>
                                <td>
                                    @if(isset($order->order_FINISHED)) <i class="fas fa-check-circle" style="color:limegreen" title="Wysłane"></i> @else <i class="far fa-circle" style="color:grey" title="Niewysłane"></i> @endif
                                </td>

                            </tr>
                        @endif
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
            <div class="float-left">Zlecenia {{$orders->firstItem()}} - {{$orders->lastItem()}} z {{$orders->total()}}</div>
            <div class="float-right">{{$orders->links()}}</div>
            
            @else
                <p>Brak dodanych zleceń</p>
            @endif
    
    </div>
</main>
@endsection