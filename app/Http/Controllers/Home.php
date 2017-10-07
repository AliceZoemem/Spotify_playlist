<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;
use DOMDocument;
use GuzzleHttp;


class Home extends Controller
{

    public function getHome(Request $request){

        $parameters = [
            'client_id' => '3a763d56ebf549c8bb288f11b8216192',
            'redirect_uri' => 'http://localhost:8080/callback',
            'response_type' => 'code',
            'scope'=>'playlist-read-private playlist-modify-public playlist-modify-private',
            'state' => '34fFs29kd09',
        ];

        $request_url =Requests::ACCOUNT_URL . '/authorize/?' . http_build_query($parameters);

        return view('welcome', [
            "spotify_url"=> $request_url
        ]);
    }


    public function write_user_db(Request $request){

        $request_code = $request->code;

        $headers = array(
            'Content-Type'=> 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . base64_encode('3a763d56ebf549c8bb288f11b8216192:057803be8875411483aecec02894d7c3'),
        );
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST',
            'https://accounts.spotify.com/api/token',
            array(
                'headers'=>$headers,
                'form_params' => array(
                    'grant_type' => 'authorization_code',
                    'code' => $request_code,
                    'redirect_uri' => 'http://localhost:8080/callback'
                )
            )
        );
        $obj = json_decode($response->getBody());

        $access_token_spotify = $obj->access_token;

        // code for Prendere informazioni utente
        $request_user_info = $client->get('https://api.spotify.com/v1/me', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $access_token_spotify,
            ],
        ]);


        dd( response()->json(json_decode($request_user_info->getBody())));



    }


}