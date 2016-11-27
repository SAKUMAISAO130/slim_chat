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

Auth::routes();

Route::get('/home', 'HomeController@index');





Route::get('/admin/login', function() {
	$auth = Auth::guard('admin');
	$credentials = [
			'email' => 'admin1@example.com',
			'password' => 'password',
	];

	return $auth->attempt($credentials) ? 'Admin Success' : 'Admin Failure';
});

	Route::get('/user/login', function() {
		$auth = Auth::guard('user');
		$credentials = [
				'email' => 'user1@test.com',
				'password' => 'password',
		];

		return $auth->attempt($credentials) ? 'User Success' : 'User Failure';
});