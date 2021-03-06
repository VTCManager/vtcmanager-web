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
    //for dev alpha on server
    if(Auth::check()){
        return redirect("/interface");
    }else{
        return redirect('/login');
    }
});
Route::get('/home', function () {
    return redirect("/");
});

Auth::routes(['verify' => true]);

Route::get('/interface', 'HomeController@index')->middleware('verified');
Route::get('/interface/logbook', 'LogbookController@index')->middleware('verified');
Route::get('/interface/account/settings/', 'SettingsController@index')->name('settings')->middleware('verified');
Route::get('/login/steam', 'Auth\LoginController@redirectToProvider');
Route::get('/login/steam/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/interface/api/job/{id}', 'APIJobController@show')->middleware('verified');