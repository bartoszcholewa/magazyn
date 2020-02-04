<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$envelopelist->envelopelist_NAME}}</title>
    <link rel="stylesheet" href="{{ ltrim(public_path('css/app.css'), '/') }}" />
    <style type="text/css">

        @charset "utf-8";

        @font-face {
            font-family: 'DejaVu Sans', sans-serif;
            src: url({{ storage_path('fonts/DejaVuSans.ttf') }});
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'DejaVu Sans', sans-serif;
            src:url({{ storage_path('fonts/DejaVuSans.ttf') }});
            font-weight: 300;
            font-style: normal;
        }

        body {
            margin-left: 60px;
            margin-right: 60px;
            background-color: #fff;
            font-family: 'DejaVu Sans', sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        .page-break {
            page-break-after: always;
        }

    </style>
</head>
<body>
    {{$envelopelist->envelopelist_NAME}}
    @foreach ($envelopelist->packets->sortBy('envelopepacket_ORDER') as $envelopepacket)
        {{$envelopepacket->envelope->envelope_ID}}<br>
        {{$envelopepacket->envelope->envelope_NAME}}<br>
        {{$envelopepacket->envelopepacket_ORDER}}<br>
    <div class="page-break"></div>
    @endforeach

</body>
</html>