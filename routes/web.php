<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//
//    return view('welcome');
//});
//Route::get('/callback', function () {
//    return view('pag_gabri/callback');
//});
Route::get('/' , 'Home@getHome');
Route::get('/authorize' , 'Home@getAuthorizeUrl');
Route::get('/callback' , 'Home@write_user_db');
//Route::post('/callback' , 'Home@final_call');