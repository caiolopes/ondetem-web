<?php

//Route::group(['middleware' => ['api']], function () {
    Route::post('api/login', 'Auth\AuthController@postLogin');
    Route::get('api/logout', 'Auth\AuthController@logout');
    Route::get('api/refresh-token', 'Auth\AuthController@refresh');

    Route::group(['middleware' => 'jwt.auth'], function() {
        Route::get('api/user', function() {
            $user = JWTAuth::parseToken()->toUser();
            return response()->json(compact('user'));
        });

        Route::get('api/place', 'PlaceController@all');
        Route::post('api/place', 'PlaceController@create');
        Route::get('api/place/{id}', 'PlaceController@get');
        Route::put('api/place/{id}', 'PlaceController@update');
        Route::delete('api/place/{id}', 'PlaceController@delete');
        Route::post('api/confirm/{id}', 'PlaceController@confirm');
    });
//});

Route::get('/', function () {
    return view('welcome');
});
