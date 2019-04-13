@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row">
        <div class="col-md-4">

            <h2>Changelog:</h2>
            <div class="card border-primary mb-3">
                <div class="card-header">v.0.1.0</div>
                <div class="card-body text-primary">
                    <h5 class="card-title">17.02.2019</h5>
                    <p class="card-text">
                        - Przeniesienie na hosting<br>
                        - Testowanie hostingu<br>
                        - Naprawa strony: cache, key, conf<br>
                        - Migracja bazy danych<br>
                        - Dostosowanie strukturalne<br>
                    </p>
                </div>
            </div>

            <div class="card border-primary mb-3">
                <div class="card-header">v.0.0.0</div>
                <div class="card-body text-primary">
                    <h5 class="card-title">19.12.2018 - 17.02.2019</h5>
                    <p class="card-text">
                        - Dostawcy CRUD<br>
                        - Materiały CRUD<br>
                        - Rolki CRUD<br>
                        - Zlecenia CRUD<br>
                        - Plan Plastyków / Vue Draggable<br>
                        - Magazyn CRUD<br>
                        - Panel Administracyjny CRUD<br>
                        - PL/EN<br>
                        - Aktywność Użytkowników<br>
                        - System Powiadomień<br>
                        - Font Awesome<br>
                        - Szybki kalkulator w zleceniu<br>
                        - Autowypełnianie rolek dla danego materiału<br>
                        - Funkcja archiwizacji rolek<br>
                        - Rozszerzono zlecenia<br>
                        - Dodano podgląd obrazu zlecenia<br>
                        - Wykorzystano JSON z adresu www zlecenia<br>
                        - Autoinkrementacja nazwy kolejnego zlecenia<br>
                        - Automatycznie pobieranie klienta dla zleceń ABC...<br>
                        - Rejestracja nowych użytkowników tylko przez admina
                    </p>
                </div>
            </div>
 
        </div>

        <div class="col-md-4">
            <h2>Do zrobienia:</h2>
            <div class="card border-dark mb-3">
                    <div class="card-header">23.02.2019</div>
                    <div class="card-body text-dark">
                        <p class="card-text">
                            <i class="fas fa-check-square"></i> - Zachowanie zlecenia po usunięciu rolki/materiału<br>
                            <i class="fas fa-check-square"></i> - Strona podglądu logów/błędów: magazyn/logs<br>
                            <i class="far fa-square"></i> - "Order by"/filtrowanie zleceń<br>
                            <i class="far fa-square"></i> - Widok klientów<br>
                            <i class="far fa-square"></i> - SLUG: Czytelne URL (np. magazyn/orders/pw-000915/)<br>
                            <i class="far fa-square"></i> - Widok dla zarządzania statusami rolek/zleceń<br>
                            <i class="far fa-square"></i> - Określ wymiar grafiki z JSON URI zlecenia<br>
                            <i class="far fa-square"></i> - Dodanie obiegu mailowego<br>
                            <i class="far fa-square"></i> - Możliwość dodania instniejącego zlecenia z widoku MAGAZYNU<br>
                            <i class="far fa-square"></i> - Dodaj adresy cache:clear po autoryzacji admina<br>
                            <i class="far fa-square"></i> - Dodaj obiegi PROMAX'a<br>
                            <i class="far fa-square"></i> - Archiwizuj zamiast usuwać<br>
                            <i class="far fa-square"></i> - Opcja wyszukiwania zlecenia<br>
                            <i class="far fa-square"></i> - Statystyki: zleceń w tym miesiącu itp.<br>
                            <i class="fas fa-check-square"></i> - Dodaj UserType: admin, handlowiec, szef, itp.<br>
                            <i class="far fa-square"></i><b> - Różne widoki dla różnych UserType</b><br>
                            <i class="far fa-square"></i> - Usuwanie zleceń z planu plastyków<br>
                        </p>
                    </div>
                </div>
        </div>
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item active"> Ostatnia aktywność 
                    <div class="float-right">
                    <a href="{{$operations->previousPageUrl()}}"><i class="fas fa-arrow-circle-left" style="color:white"></i></a> 
                    {{ $operations->currentPage() }} / {{ $operations->lastPage() }} 
                        <a href="{{$operations->nextPageUrl()}}"><i class="fas fa-arrow-circle-right" style="color:white"></i></a>
                    </div>
                </li>
                @foreach($operations as $operation)
            <li class="list-group-item">{!!$operation->operation_NAME!!}<small> - {{$operation->user->name}} - {{ $diff = Carbon\Carbon::parse($operation->operation_DATETIME)->diffForHumans() }}</small></li>
                @endforeach
              </ul>
        </div>

        </div>
    </div>
</main>
@endsection