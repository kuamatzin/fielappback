<?php

use App\Business;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/businesses', function () {
    return Business::all();
});

Auth::routes();

Route::get('/home', 'HomeController@index');
