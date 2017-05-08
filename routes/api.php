<?php

use App\User;
use Illuminate\Http\Request;

Route::post('/logins', function(Request $request){
    $credentials = $request->only('email', 'password');
    $token = null;

    try {
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials', 'status' => 2]);
        }

    } catch(JWTException $e) {
        return response()->json(['error' => 'Something happen', 'status' => 3], 500);
    }

    $user = JWTAuth::toUser($token);
    $status = 1;

    return response()->json(compact('token', 'user', 'status'));
});

Route::get('/token', function(){
    if ( ! $user = JWTAuth::parseToken()->authenticate() ) {
        return response()->json(['User Not Found'], 404);
    }
 
    $user = JWTAuth::parseToken()->authenticate();
    $token = JWTAuth::getToken();
    $token = JWTAuth::refresh($token);

    return response()->json(['user' => $user->toJson(), 'token' => $newToken], 200);
})->middleware('jwt.auth');


Route::get('/cards/{user_id}', function($user_id){
    $cards = User::findOrFail($user_id)->cards;
    return response()->json(compact('cards'), 200);
})->middleware('jwt.auth');

