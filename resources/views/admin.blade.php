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
        @foreach ($list_users as $user)
            <p>Aggiungi canzone a <u>{{ $user->id_user }}</u></p><button >AGGIUNGI</button>
        @endforeach





    </body>

</html>

