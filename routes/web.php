<?php


Route::group(['prefix' => 'Api_v1'], function()
{


    Route::get('/', function () {
        return response()->json(['message' => 'Loja API', 'status' => 'Connected']);;
    });

  Route::resource('clientes', 'Api_v1\Clientes\ClientesController');
  Route::resource('usuarios', 'Api_v1\Usuarios\UsuariosController');
  Route::resource('produtos', 'Api_v1\Produtos\ProdutosController');



});
