<?php

use App\Business;
use App\Card;
use App\User;

Route::get('/', function () {
    $user = User::findOrFail(301);
    return $user->cards->where('reward', '>', 60);
});

Route::get('/businesses', function () {
    return Business::all();
});

Route::get('/businesses/{businesses_id}/cards', function ($business_id) {
    return Card::where('business_id', $business_id)->get();
});

Route::get('/cards', function () {
    return Card::with('business')->get();
});

Route::get('/cards/{businesses_type}', function ($businesses_type) {
    $business_ids = Business::select('id')->where('businesses_type', $businesses_type)->get()->pluck('id')->toArray();
    $cards = Card::with('business')->whereIn('business_id', $business_ids)->get();
    return $cards;
});

Auth::routes();

Route::get('/home', 'HomeController@index');
