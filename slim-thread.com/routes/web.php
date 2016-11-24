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

Route::get('/', function () {
    return view('welcome');
});


	Route::get('boards','BoardController@Index');
	Route::get('boards/create','BoardController@create');
	Route::post('boards/done','BoardController@done');
	
	





