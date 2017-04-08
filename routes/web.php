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
Route::post('/home', 'HomeController@changePassword')->name('home.changePassword');
Route::put('/home', 'HomeController@changeProfile')->name('home.changeProfile');

Route::group(['middleware' => 'auth'], function() {
    Route::post('contact/send', 'ContactController@sendSms')->name('contact.sendSms');
	Route::resource('contact', 'ContactController');

	Route::post('group/send', 'GroupController@sendSms')->name('group.sendSms');
	Route::post('group/{group}', 'GroupController@storeMember')->name('group.storeMember');
	Route::delete('group/{group}/{contact}', 'GroupController@destroyMember')->name('group.destroyMember');
	Route::resource('group', 'GroupController');

	Route::resource('message', 'MessageController');
});

