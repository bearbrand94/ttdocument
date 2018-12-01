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
    return redirect("login");
});

Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::get('/home', 'HomeController@index')->name('home');
	// profile
	Route::get('user/profile', 'HomeController@my_profile')
	    ->middleware('can:manage-my-account');
	Route::get('user/password', 'HomeController@change_password_form')
	    ->middleware('can:manage-my-account');
	Route::post('user/password/change', 'HomeController@change_password')
	    ->middleware('can:manage-my-account');


	Route::get('document/send', 'DocumentSendController@index')
	    ->middleware('can:manage-document-send');
	Route::get('document/send/list', 'DocumentSendController@get_list')
	    ->middleware('can:manage-document-send');
	Route::get('document/send/detail', 'DocumentSendController@get_detail')
	    ->middleware('can:manage-document-send');
	Route::get('document/send/print', 'DocumentSendController@print_detail')
	    ->middleware('can:manage-document-send');
	Route::get('document/send/new', 'DocumentSendController@new_form')
	    ->middleware('can:create-document-send');
	Route::post('document/send/insert', 'DocumentSendController@store')
	    ->middleware('can:create-document-send');

    Route::post('/document/send/accept', 'DocumentSendController@accept')
        ->middleware('can:review-document-send');
    Route::post('/document/send/reject', 'DocumentSendController@reject')
        ->middleware('can:review-document-send');


	Route::get('document/receive', 'DocumentReceiveController@index')
        ->middleware('can:manage-document-receive');
	Route::get('document/receive/list', 'DocumentReceiveController@get_list')
	    ->middleware('can:manage-document-receive');
	Route::get('document/receive/detail', 'DocumentReceiveController@get_detail')
	    ->middleware('can:manage-document-receive');
	Route::get('document/receive/print', 'DocumentReceiveController@print_detail')
	    ->middleware('can:manage-document-receive');
	Route::get('document/receive/new', 'DocumentReceiveController@new_form')
	    ->middleware('can:create-document-receive');
	Route::post('document/receive/insert', 'DocumentReceiveController@store')
	    ->middleware('can:create-document-receive');

	Route::post('/document/receive/accept', 'DocumentReceiveController@accept')
        ->middleware('can:review-document-receive');
    Route::post('/document/receive/reject', 'DocumentReceiveController@reject')
        ->middleware('can:review-document-receive');

    // User Controller
	Route::get('user', 'UserController@index')
	    ->middleware('can:manage-user');
	Route::get('user/manage', 'UserController@index')
	    ->middleware('can:manage-user');
	Route::get('user/list', 'UserController@get_list')
	    ->middleware('can:manage-user');

    // Change Access Role
	Route::get('user/access/change', 'UserController@change_access_form')
	    ->middleware('can:manage-user');
	Route::post('user/access/change', 'UserController@change_access')
	    ->middleware('can:manage-user');

	// Client Controller
	Route::get('client', 'ClientController@index')
	    ->middleware('can:manage-client');
	Route::get('client/manage', 'ClientController@index')
	    ->middleware('can:manage-client');
	Route::get('client/list', 'ClientController@get_list')
	    ->middleware('can:manage-client');
	Route::get('client/new', 'ClientController@new_form')
	    ->middleware('can:manage-client');
	Route::post('client/insert', 'ClientController@store')
	    ->middleware('can:manage-client');
	Route::get('client/update', 'ClientController@update_form')
	    ->middleware('can:manage-client');
	Route::post('client/update', 'ClientController@update')
	    ->middleware('can:manage-client');

	// Relation Manager
	Route::get('relation/supervisor/manage', 'RelationController@supervisor_form')
	    ->middleware('can:manage-supervisor-staff-relation');
	Route::post('relation/supervisor/add', 'RelationController@add_supervisor_relation')
	    ->middleware('can:manage-supervisor-staff-relation');
	Route::post('relation/supervisor/delete', 'RelationController@remove_supervisor_relation')
	    ->middleware('can:manage-supervisor-staff-relation');

	Route::get('relation/staff/manage', 'RelationController@staff_form')
	    ->middleware('can:manage-staff-client-relation');
	Route::post('relation/staff/add', 'RelationController@add_staff_relation')
	    ->middleware('can:manage-staff-client-relation');
	Route::post('relation/staff/delete', 'RelationController@remove_staff_relation')
	    ->middleware('can:manage-staff-client-relation');

});