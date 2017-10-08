<?php
namespace App\Http\Controllers;
use App\Playlist_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;
use DOMDocument;
use GuzzleHttp;


class Home extends Controller
{

    public function getHome(Request $request){
        //playlist-modify-public playlist-read-private playlist-modify-private
        $parameters = [
            'client_id' => '3a763d56ebf549c8bb288f11b8216192',
            'redirect_uri' => 'http://localhost:8080/callback',
            'response_type' => 'code',
            'scope'=>'user-read-private user-read-email playlist-modify-public playlist-read-private playlist-modify-private',
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
        //$access_token_spotify = "BQCkslBRSeWuaCy4Qk03UdOQGOdoPSD9pEqaz1N01RSUmVHvklDlJio4iVQc-V26_DtnLA--82xahlqC_wcbFPZtRs9p2PT2R_Y-rOvkgObMJ9JHwiWt828aavPUO2sl-1iZh95jrmcxfKsQsujJeJJ0bud1";

        //code for Prendere informazioni utente
        $request_user_info = $client->get('https://api.spotify.com/v1/me', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $access_token_spotify,
            ],
        ]);


       // $user_id = response()->json(json_decode($request_user_info->getBody()));
        $country = json_decode($request_user_info->getBody())->country;
        $email = json_decode($request_user_info->getBody())->email;
        $uri = json_decode($request_user_info->getBody())->uri;
        $id_user = json_decode($request_user_info->getBody())->id;
        dd($country . $email . $uri .$id_user);
        $controlla_id_user = Playlist_user::where('id_user', $id_user)->get();
        if($controlla_id_user->isEmpty()){
            $new_user = new Playlist_user();

            $new_user->id_user = $id_user;
            $new_user->uri = $uri;
            $new_user->email = $email;
            $new_user->country = $country;
            $new_user->save();
        }



    }


}