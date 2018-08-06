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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('document/send', 'DocumentSendController@index');
Route::get('document/send/list', 'DocumentSendController@get_list');

Route::get('document/receive', 'DocumentReceiveController@index');
Route::get('document/receive/list', 'DocumentReceiveController@get_list');

Route::get('user', 'UserController@index');
Route::get('user/list', 'UserController@get_list');