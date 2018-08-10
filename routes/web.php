<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'Api_v1'], function()
{


    Route::get('/', function () {
        return response()->json(['message' => 'Loja API', 'status' => 'Connected']);;
    });

  // Clientes
  Route::resource('usuarios', 'Api_v1\Usuarios\UsuariosController');
  Route::resource('clientes', 'Api_v1\Clientes\ClientesController');
  Route::resource('produtos', 'Api_v1\Produtos\ProdutosController');











});
