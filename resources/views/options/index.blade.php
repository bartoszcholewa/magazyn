@extends('layouts.app')
@section('content')
@include('includes.messages')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">  
    <div class="col-md-6">
        <h2 style="display: inline-block">Ustawienia Ogólne:</h2>
        @if (count($options) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-sm">      
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa opcji</th>
                            <th>Wartość opcji</th>
                            <th>Autoload</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>     
                    <tbody>
                    @foreach ($options as $option)
                        <tr>
                            <td>{{$option->option_ID}}</td>
                            <td>{{$option->option_NAME}}</td>
                            <td>{{$option->option_VALUE}}</td>
                            <td>{{$option->option_AUTOLOAD}}</td>
                            <td><a class="btn btn-primary btn-sm" href="/options/{{ $option->option_ID }}/edit" role="button">Edytuj</a>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>            
            @else
                <p>Brak dodanych ustawień</p>
            @endif
    
    </div>
</main>
@endsection