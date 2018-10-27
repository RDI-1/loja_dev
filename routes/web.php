<?php

Route::group(['prefix' => 'api_v1'], function () {


    Route::get('/', function () {
        return response()->json(['message' => 'Loja API', 'status' => 'Connected']);
    });


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
