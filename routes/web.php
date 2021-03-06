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

Route::get('/' , 'Home@getHome');
Route::get('/callback' , 'Home@write_user_db');

Auth::routes();
Route::get('/admin', 'Home@getusers')->middleware('auth');
Route::get('/playlist', 'Home@createplaylist')->middleware('auth');
Route::get('/playlist_user/{id}', 'Home@createplaylistforuser')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
