<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="icon" href="{{asset('css/favicon.ico')}}">
        <title>{{config('app.name', 'MAGAZYN')}}</title>
    </head>
    <body>
        
        @include('includes.navbar')
            @yield('content')

            </div>
        </div>

    @include('includes.scripts')

    </body>
</html>
