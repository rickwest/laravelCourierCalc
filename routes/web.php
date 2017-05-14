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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', function(){
    return view('dashboard');
});

//QuoteController Routes
Route::get('/quote/create', 'QuoteController@create');

Route::post('/quote', 'QuoteController@store');

Route::post('/quote/email', 'QuoteController@email');

