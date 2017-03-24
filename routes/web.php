<?php

use App\Business;
use App\Card;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/businesses', function () {
    return Business::all();
});

Route::get('/businesses/{businesses_id}/cards', function ($business_id) {
    return Card::where('business_id', $business_id)->get();
});

Auth::routes();

Route::get('/home', 'HomeController@index');
