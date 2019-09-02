@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row">
        <div class="col-md-4">

            <h2>{{ __('Changelog:') }}</h2>
            <div class="card border-primary mb-3">
                <div class="card-header">v.0.1.3</div>
                <div class="card-body text-primary">
                    <h5 class="card-title">01.07.2019</h5>
                    <p class="card-text">
                        - Umieszczono wersje v.0.1.2 na XAMPP Grafik-02 <br>
                        - Poprawiono opcję wysyłania maili z potwierdzeniem zlecenia (jeśli zlecenie nie jest kalibracją albo nie jest "Nowe")<br>
                        - Zablokowano edycję zatwierdzonych zleceń<br>
                        - Dodano możliwość zmiany ilości sztuk zlecenia<br>
                        - Dodano wartość "Typ" do materiałów<br>
                        - Mail z potwierdzeniem zlecenia zawiera odpowiednio zformatowany moduł do Planu Plastyków (wersja OOCalc) <br>
                        - Dodano możliwość wejścia w zlecenie po kliknięciu w rząd zlecenia (jQuery)<br>
                        - Zrezygnowano ze "Statusu" zlecenia - rozbito to na wartości Zatwierdzone, Wydrukowane i Wysłane<br>
                        - Typ opcji "Autoload" w mailach określa czy maile mają być wysłane na ten mail, czy nie.<br>
                        - Dodano możliwość zmiany statusu zlecenia z pozycji podglądu zlecenia<br>
                        - Dodano opcję filtrowania listy zleceń / wyszukiwanie<br>
                        - Dodano "+ laminacja" w module mailowym do Planu Plastyków (OOCalc)<br>
                        - Poprawiono sortowanie listy rolek po dacie rolki<br>
                        - Dodano opcję zmiany paginacji dla zleceń<br>
                        - Dodano opcję typu strony production/development<br>
                        - Tylko admin lub development może usuwać zatwierdzone zlecenia<br>
                        - Poprawiono autopopulacje materiał->rolka, nie pokazuje zakończonych i pokazuje aktualny wymiar rolki<br>
                    </p>
                </div>
            </div>
            <div class="card border-primary mb-3">
                <div class="card-header">v.0.1.2</div>
                <div class="card-body text-primary">
                    <h5 class="card-title">28.04.2019 - 03.05.2019</h5>
                    <p class="card-text">
                        - Dodano Ustawienia Ogólne (zmiana maili obiegowych, nazwa programu, wersja programu)<br>
                        - Dodano funkcję pobierania konfiguracji programu bezpośrednio z bazy danych<br>
                        - Rozszerzono Ustawienia Ogólne o "mail driver"<br>
                        - Automatyczne czyszczenie cache po zmianie w Ustawieniach Ogólnych<br>
                        - Dodano zdalny dostęp do funkcji czyszczenia pamięci podręcznej<br>
                        - Poprawiono politykę dostępu.<br>
                        - Zoptymalizowano zapytania bazy danych (eager loading)<br>
                        - Dodano narzędzie Telecope<br>
                        - DigitalOcean deploy<br>
                    </p>
                </div>
            </div>
            <div class="card border-primary mb-3">
                <div class="card-header">v.0.1.1</div>
                <div class="card-body text-primary">
                    <h5 class="card-title">13.04.2019 - 28.04.2019</h5>
                    <p class="card-text">
                        - Poprawiono zachowanie zlecenia po usunięciu rolki/materiału<br>
                        - Dodano strone podglądu logów/błędów: magazyn/logs<br>
                        - Dodano własny widok dodawania użytkowników: /users/create/<br>
                        - Dodano UserType: admin, handlowiec, szef, itp.<br>
                        - Poprawiono zachowanie widoku użykownika po jego usunięciu: error message<br>
                        - Wyłączono wbudowaną funkcje register<br>
                        - Uzupełniono walidacje tworzenia użytkownika<br>
                        - Lokalizacja walidacji tworzenia użytkownika<br>
                        - Lokalizacja strony głównej<br>
                        - Mailowe zatwierdzanie zleceń przez szefa<br>
                        - Zatwierdzone maile idą na kolejny adres<br>
                        - Dodano Ustawienia Ogólne (zmiana maili obiegowych, nazwa programu, wersja programu)<br>
                        - Dodano funkcję pobierania konfiguracji programu bezpośrednio z bazy danych<br>
                        - Rozszerzono Ustawienia Ogólne o "mail driver"<br>
                        - Automatyczne czyszczenie cache po zmianie w Ustawieniach Ogólnych<br>
                        - Dodano zdalny dostęp do funkcji czyszczenia pamięci podręcznej<br>
                        - Poprawiono politykę dostępu.<br>
                    </p>
                </div>
            </div>

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
            <h2>{{ __('TODO:') }}</h2>
            <div class="card border-dark mb-3">
                    <div class="card-header">23.02.2019 - v.0.1.1</div>
                    <div class="card-body text-dark">
                        <p class="card-text">
                            <i class="far fa-square"></i> - Widok listy klientów<br>
                            <i class="far fa-square"></i> - SLUG: Czytelne URL (np. magazyn/orders/pw-000915/)<br>
                            <i class="far fa-square"></i> - Widok dla zarządzania statusami rolek/zleceń<br>
                            <i class="far fa-square"></i> - Określ wymiar grafiki z JSON URI zlecenia<br>
                            <i class="far fa-square"></i> - Dodaj przycisk cache:clear po autoryzacji admina<br>
                            <i class="far fa-square"></i><b> - Dodaj obiegi PROMAX'a</b><br>
                            <i class="far fa-square"></i> - Archiwizuj zamiast usuwać<br>
                            <i class="far fa-square"></i> - Opcja wyszukiwania zlecenia<br>
                            <i class="far fa-square"></i> - Statystyki: zleceń w tym miesiącu itp.<br>
                            <i class="far fa-square"></i> - Różne widoki dla różnych UserType<br>
                            <i class="far fa-square"></i> - Usuwanie zleceń z planu plastyków<br>
                            <i class="far fa-square"></i> - Statystyki poszczególnych użytkowników w widoku użytkownika<br>
                            <i class="far fa-square"></i><b> - CACHE</b><br>
                            <i class="far fa-square"></i> - Pobieraj Options->firstmail itp. z faktycznych kont użytkowników<br>

                        </p>
                    </div>
                </div>
        </div>
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item active"> {{ __(' Recent activity: ') }}
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