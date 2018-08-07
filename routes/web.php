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

Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('document/send', 'DocumentSendController@index');
	Route::get('document/send/list', 'DocumentSendController@get_list');
	Route::get('document/send/detail', 'DocumentSendController@get_detail');
	Route::get('document/send/print', 'DocumentSendController@print_detail');
	Route::get('document/send/new', 'DocumentSendController@new_form');
	Route::post('document/send/insert', 'DocumentSendController@store');

	Route::get('document/receive', 'DocumentReceiveController@index');
	Route::get('document/receive/list', 'DocumentReceiveController@get_list');
	Route::get('document/receive/detail', 'DocumentReceiveController@get_detail');
	Route::get('document/receive/print', 'DocumentReceiveController@print_detail');

	Route::get('user', 'UserController@index');
	Route::get('user/list', 'UserController@get_list');

	Route::get('client', 'ClientController@index');
	Route::get('client/list', 'ClientController@get_list');
});