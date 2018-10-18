<?php

Route::group(['prefix' => 'api_v1'], function () {


    Route::get('/', function () {
        return response()->json(['message' => 'Loja API', 'status' => 'Connected']);
    });


});
