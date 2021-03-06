<?php

use Illuminate\Support\Facades\Route;

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
    return view('client.index');
});
//Route::get('/success', function (){
//    return view('client.success');
//});
Auth::routes((['register' => false]));

Route::get('/balance', 'BalanceController@index')->name('balance');


Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('users', 'UserController')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::post('/confirm','AirtimeController@confirm')->name('confirm');
Route::get('/confirm','AirtimeController@confirm')->name('confirm');
Route::post('/pay','AirtimeController@payment')->name('pay');
Route::get('/pay','AirtimeController@payment')->name('pay');
Route::post('/validate','AirtimeController@success')->name('success');
Route::get('/key','AirtimeController@get_key');
