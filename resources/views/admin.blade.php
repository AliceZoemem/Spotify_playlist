{{--
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
            <p>Aggiungi canzone a <u>{{ $user->id_user }}</u></p><button href="/playlist/{{$user->id_user}}">AGGIUNGI</button>
        @endforeach

    </body>

</html>

--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <a class="btn btn-info pull-right" href="/playlist">Push song for everyone</a>

        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th>Email</th>
                <th>Country</th>
                <th>ID User</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
        @foreach ($list_users as $user)
            <tr>
                <td>{{$user->email}}</td>
                <td>{{$user->country}}</td>
                <td>{{$user->id_user}}</td>
                <td><a class="btn btn-success" href="/playlist_user/{{$user->id_user}}">Push Song</a></td>
        @endforeach
    </div>
@endsection