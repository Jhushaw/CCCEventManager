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

Route::get ( '/', function () {
	return view ( 'showLogin' );
} );

Route::get ( '/Register', function () {
	return view ( 'showRegister' );
} );

Route::get ( '/Login', function () {
	return view ( 'showLogin' );
} );

Route::get ( '/Calendar', function () {
	return view ( 'showCalendar' );
} );

Route::get ( '/Events', function () {
	return view ( 'showEvents' );
} );

Route::get ( '/EventDetailed', function () {
	return view ( 'showEventDetailed' );
} );

//post route
Route::post('dologin', 'LoginController@userLogin');
Route::post('doregister', 'RegisterController@userRegister');
