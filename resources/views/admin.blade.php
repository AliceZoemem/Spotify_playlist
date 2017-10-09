<!DOCTYPE html>

<html>

    <head>
        <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}" />
        <title>Spotify</title>
    </head>

    <body >
    <div id="intro">
        <p class="welcome">Welcome</p>
        <img alt="spotify_logo" id="spotify_logo" src="Spotify_Logo_CMYK_White.png">

    </div>

    <p>{{$results}}</p>
    {{--<a href="{{$spotify_url}}" ><button class="playlist_button">AGGIUNGI CANZONI</button></a>--}}


    </body>

</html>

