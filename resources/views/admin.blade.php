<!DOCTYPE html>

<html>

    <head>
        <script src="{{ asset('/js/Gabri.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}" />
        <title>Spotify</title>
    </head>

    <body >
    <div id="intro">
        <p class="welcome">Welcome</p>
        <img alt="spotify_logo" id="spotify_logo" src="Spotify_Logo_CMYK_White.png">

    </div>

        <a href="{{$spotify_url}}" ><button class="playlist_create">CREA PLAYLIST</button></a>


    </body>

</html>

