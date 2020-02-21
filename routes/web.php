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

use Illuminate\Support\Facades\Auth;




Route::get('/', function () {
    return view('welcome');
});


Route::get('/file','FileController@index')->name('viewfile')->middleware('auth');

Route::get('/file/upload','FileController@create')->name('formfile')->middleware('auth');

Route::post('/file/upload','FileController@store')->name('uploadfile')->middleware('auth');

Route::get('/file/download/{id}','FileController@show')->name('downloadfile')->middleware('auth');

Route::delete('/file/{id}','FileController@destroy')->name('deletefile')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


