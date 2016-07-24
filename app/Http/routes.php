<?php

//Route::group(['middleware' => ['api']], function () {
    Route::post('api/login', 'Auth\AuthController@loginJwt');
    Route::get('api/logout', 'Auth\AuthController@logoutJwt');
    Route::get('api/refresh-token', 'Auth\AuthController@refreshJwt');

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
        Route::get('api/categories/', 'PlaceTypeController@categories');
        Route::get('api/types/', 'PlaceTypeController@types');
    });
//});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories/', [
    'middleware' => 'auth',
    'uses' => 'PlaceTypeController@categories'
]);

Route::get('/types/', [
    'middleware' => 'auth',
    'uses' => 'PlaceTypeController@types'
]);

Route::get('/place/add', 'PlaceController@addNewPlaceForm');
Route::post('/place', 'PlaceController@addNewPlace');
//Route::get('/places', 'PlaceController@list');
//Route::delete('/place', 'PlaceController@');

Route::auth();

Route::get('/home', 'HomeController@index');