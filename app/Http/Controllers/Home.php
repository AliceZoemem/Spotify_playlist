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

        $parameters = [
<<<<<<< HEAD
            'client_id' => '3a763d56ebf549c8bb288f11b8216192',
            'redirect_uri' => 'http://localhost:8080/callback',
=======
            'client_id' => env('SPOTIFY_APP_CLIENT_ID'),
            'redirect_uri' => env('SPOTIFY_APP_REDIRECT_URI'),
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
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
<<<<<<< HEAD
            'Authorization' => 'Basic ' . base64_encode('3a763d56ebf549c8bb288f11b8216192:057803be8875411483aecec02894d7c3'),
=======
            'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_APP_CLIENT_ID').':'.env('SPOTIFY_APP_SECRET_KEY')),
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
        );
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST',
            'https://accounts.spotify.com/api/token',
            array(
                'headers'=>$headers,
                'form_params' => array(
                    'grant_type' => 'authorization_code',
                    'code' => $request_code,
<<<<<<< HEAD
                    'redirect_uri' => 'http://localhost:8080/callback'
=======
                    'redirect_uri' => env('SPOTIFY_APP_REDIRECT_URI')
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
                )
            )
        );
        $obj = json_decode($response->getBody());

        $access_token_spotify = $obj->access_token;
        $refresh_token_spotify = $obj->refresh_token;

        $request_user_info = $client->get('https://api.spotify.com/v1/me', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $access_token_spotify,
            ],
        ]);

        $country = json_decode($request_user_info->getBody())->country;
        $email = json_decode($request_user_info->getBody())->email;
        $uri = json_decode($request_user_info->getBody())->uri;
        $id_user = json_decode($request_user_info->getBody())->id;

        $check_id_user = Playlist_user::where('id_user', $id_user)->get();
        if($check_id_user->isEmpty()){


            $new_user = new Playlist_user();

            $new_user->id_user = $id_user;
            $new_user->uri = $uri;
            $new_user->email = $email;
            $new_user->country = $country;
            $new_user->refresh_token = $refresh_token_spotify;
            $new_user->auth_token = $access_token_spotify;

            $new_user->save();
            $message = "Good Job!";

        }
        else{
            $message = "Already registered";
        }

        return view('thanks', [
            'message' => $message
        ]);


    }
    public function createplaylist(){
        $list_user = Playlist_user::where('injected', false)->get();
        $client = new GuzzleHttp\Client();
<<<<<<< HEAD

        if($list_user->isEmpty()){
            $results = "There are no users";
        }else{

=======
        if($list_user->isEmpty()){
            $results = "There are no users";
        }else{
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
            foreach ($list_user as $user) {
                $spotify_id = $user->id_user;
                $spotify_access_token = $user->auth_token;
                $spotify_refresh_token = $user->refresh_token;
                try {
                    $request_user_info = $client->get('https://api.spotify.com/v1/users/' . $spotify_id, [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $spotify_access_token,
                        ],
                    ]);
                    $obj = json_decode($request_user_info->getBody());
<<<<<<< HEAD

=======
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
                    $new_access_token_spotify = $obj->access_token;
                }
                catch (\Exception $e){
                    $response = $client->request('POST',
                        'https://accounts.spotify.com/api/token',
                        array(
                            'headers' => [
                                'Accept' => 'application/json',
<<<<<<< HEAD
                                'Authorization' => 'Basic ' . base64_encode('3a763d56ebf549c8bb288f11b8216192:057803be8875411483aecec02894d7c3'),
=======
                                'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_APP_CLIENT_ID').':'.env('SPOTIFY_APP_SECRET_KEY')),
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
                            ],
                            'form_params' => array(
                                'grant_type' => 'refresh_token',
                                'refresh_token' => $spotify_refresh_token
                            )
                        )
                    );
                    $obj = json_decode($response->getBody());
<<<<<<< HEAD

                    $new_access_token_spotify = $obj->access_token;
                    $catch_access_token = Playlist_user::where('id_user', $spotify_id)->first();

                    $catch_access_token->auth_token = $new_access_token_spotify;
                    $catch_access_token->save();
                }

=======
                    $new_access_token_spotify = $obj->access_token;
                    $catch_access_token = Playlist_user::where('id_user', $spotify_id)->first();
                    $catch_access_token->auth_token = $new_access_token_spotify;
                    $catch_access_token->save();
                }
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
                $request_user_playlists = $client->get('https://api.spotify.com/v1/users/' . $spotify_id . '/playlists', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $new_access_token_spotify,
                    ],
                ]);
                $playlist = json_decode($request_user_playlists->getBody());
                $playlist_found = false;
                foreach($playlist->items as $playlist_name){
                    $single_name = $playlist_name->name;
                    if($single_name == "In The Town"){
                        $playlist_found = true;
                        $playlist_id = $playlist_name->id;
                        $results= "No playlists create ";
                    }
                }
                if(!$playlist_found){
                    $results= "Create new playlist for ";
                    $form_params = json_encode(array(
                        'name' => 'In The Town',
<<<<<<< HEAD

                    ));

=======
                    ));
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
                    $create_playlist = $client->request('POST',
                        'https://api.spotify.com/v1/users/'.$spotify_id .'/playlists',
                        array(
                            'headers' => [
                                'Content-Type' => 'application/json',
                                'Authorization' => 'Bearer ' . $new_access_token_spotify,
                            ],
                            'body' => $form_params
                        )
                    );
                    $playlist_id =(json_decode($create_playlist->getBody()))->id;
<<<<<<< HEAD

                    $results = $results. $spotify_id ." ";

                }




            }

        }
//        $body_track = json_encode(
//            array(
//                'uris' =>  array('spotify:track:6w36pmMA5bxECalu5rxQAw'))
//            );
        $body_track = json_decode('{"uri" : "spotify:track:6Ijb2xCO37OOFQra6gzYGl"}');

        $add_song = $client->request('POST',
            'https://api.spotify.com/v1/users/'.$spotify_id .'/playlists/'.$playlist_id.'/tracks',
=======
                    $results = $results. $spotify_id ." ";
                }
            }
        }

        $add_song = $client->request('POST',
            'https://api.spotify.com/v1/users/'.$spotify_id .'/playlists/'.$playlist_id.'/tracks?uris='.env('SPOTIFY_TRACK_URI'),
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
            array(
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $new_access_token_spotify,
<<<<<<< HEAD
                ],
                'track' => $body_track
            )
        );

        return view('admin', [
            "results"=> $results
        ]);


=======
                ]
            )
        );
        dd($add_song);
        return view('admin', [
            "results"=> $results
        ]);
>>>>>>> da94929b109cb078c496738322aaa71fafe04d3a
    }

}