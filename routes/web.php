<?php

Route::group(['prefix' => 'api_v1'], function () {


    Route::get('/', function () {
        return response()->json(['message' => 'Loja API', 'status' => 'Connected']);;
    });

    Route::resource('teste', 'api_v1\TesteController');
    Route::resource('clientes', 'api_v1\Clientes\ClientesController');
    
    Route::resource('usuarios', 'api_v1\Usuarios\UsuariosController');
    Route::resource('produtos', 'api_v1\Produtos\ProdutosController');

});
