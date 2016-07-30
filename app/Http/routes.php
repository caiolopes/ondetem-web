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

        Route::get('api/place', 'PlaceApiController@all');
        Route::post('api/place', 'PlaceApiController@create');
        Route::get('api/place/{id}', 'PlaceApiController@get');
        Route::put('api/place/{id}', 'PlaceApiController@update');
        Route::delete('api/place/{id}', 'PlaceApiController@delete');
        Route::post('api/confirm/{id}', 'PlaceApiController@confirm');
        Route::get('api/categories/', 'PlaceTypeController@categories');
        Route::get('api/types/', 'PlaceTypeController@types');
    });
//});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/categories/', [
    'middleware' => 'auth',
    'uses' => 'PlaceTypeController@categories'
]);

Route::get('/types/', [
    'middleware' => 'auth',
    'uses' => 'PlaceTypeController@types'
]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/places/search', 'PlaceWebController@getIndex');
    Route::get('/places', 'PlaceWebController@getPlaces');
    Route::get('/place', 'PlaceWebController@getAdd');
    Route::post('/place', 'PlaceWebController@postAdd');
    Route::get('/place/confirm', 'PlaceWebController@getConfirm');
    Route::get('/place/{id}', 'PlaceWebController@getPlace');
    Route::get('/place/edit/{id}', 'PlaceWebController@getEdit');
    Route::post('/place/edit', 'PlaceWebController@postEdit');
    Route::delete('/place/{id}', 'PlaceWebController@deletePlace');
});

Route::auth();