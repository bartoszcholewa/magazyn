<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{ config('options.appname')}} {{ config('options.appversion')}}</title>
    </head>
    <body>
        @if(Auth::check())
        @include('includes.navbar')
        @endif
            @yield('content')

            </div>
        </div>

@include('includes.scripts')

    </body>
</html>
