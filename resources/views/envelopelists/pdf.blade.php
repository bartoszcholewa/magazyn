<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$envelopelist->envelopelist_NAME}}</title>
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
            margin-top: -10px;
            margin-left: -10px;
            margin-right: -10px;
            margin-bottom: -10px;
            background-color: #fff;
            font-family: 'DejaVu Sans', sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        .page-break {
            page-break-after: always;
        }

        div.logo img {
            float: left;
            height: 75px;
            margin-right: 10px;
        }
        
        div.logo ul {
            font-size: 10px;
            list-style-type: none;
            list-style-image: none;
            margin: 0;
            padding: 0px;
        }

        div.footer img {
            height: 65px;
            z-index: 9999999999999;
            position: absolute;
            top: 300px;
            left: 3px;
        }

        div.adres ul {
            font-size: 16px;
            list-style-type: none;
            list-style-image: none;
            margin: 0;
            padding: 0px;
            text-align: right;
            z-index: 9999999999999;
            position: absolute;
            top: 130px;
        }

    </style>
</head>
<body>
    @php $i = 0; $len = count($envelopelist->packets->sortBy('envelopepacket_ORDER')); @endphp 
    @foreach ($envelopelist->packets->sortBy('envelopepacket_ORDER') as $envelopepacket)
        <div class="logo">
            <img src="{{asset('images/logo-promax.jpg')}}" alt="Logo">
            <ul>
                <li>&nbsp;</li>
                <li>&nbsp;</li>
                <li><b>PROMAX II s.c.</b></li>
                <li>ul. Krakowska 98</li>
                <li>50-427 Wrocław</li>
            </ul>
        </div>
        <div class="adres">
            <ul>
                <b><li>{{$envelopepacket->envelope->envelope_COMPANY}}</li>
                <li>{{$envelopepacket->envelope->envelope_PERSON}}</li></b>
                <li>{{$envelopepacket->envelope->envelope_STREET}}</li>
                <li>{{$envelopepacket->envelope->envelope_ZIPCODE}}
                    {{$envelopepacket->envelope->envelope_CITY}}</li>
            </ul>
        </div>
        <div class="footer">
            <img src="{{asset('images/footer-promax.jpg')}}" alt="Logo">
        </div>

        @if ($i == $len - 1) @else <div class="page-break"></div> @endif @php $i++; @endphp
    @endforeach

</body>
</html>