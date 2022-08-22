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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Auth::routes([
	'verify' => false,
	'register' => false,
	'reset' => false,
]);

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');

Route::resource('videos', 'VideosController');

Route::resource('videoRequests', 'VideoRequestsController')
	->except('create');

Route::resource('notifications', 'NotificationsController')
	->only([
		'index',
		'show',
	]);