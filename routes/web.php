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

Route::get('test', function(){
    $cards = User::findOrFail(31)->cards()->where('completed', true)->get();
    dd($cards);
});

Route::get('/signCard/{card_id}/{user_id}', function($card_id, $user_id){
    //Existe un record con la tarjeta entonces hay que sellarla
    $user = User::find($user_id);

    if($card = $user->cards->find($card_id)){
        $total_uses_to_complete = $card->uses;
        $current_uses_plus_one = $card->pivot->uses + 1;
        if (!$completed = $card->pivot->completed) {
            $params_to_update = $total_uses_to_complete == $current_uses_plus_one ? ['uses' => $current_uses_plus_one, 'completed' => true] : ['uses' => $current_uses_plus_one];
            $user->cards()->updateExistingPivot($card_id, $params_to_update, true);
        }
        else {
            dd("Esta tarjeta ha sido completada");
        }
    }
    else {
        $user->cards()->attach($card_id, ['uses' => 1]);
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index');
