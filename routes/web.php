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
Route::get('/admin', 'Home@getusers');
Route::get('/playlist', 'Home@createplaylist');

//BQAa09I9s-su7Sisyvo9HL9GGD4TZB2CA3298ZVDG2JglvvbI-
//