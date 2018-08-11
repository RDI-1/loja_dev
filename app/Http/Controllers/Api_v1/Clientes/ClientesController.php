<?php

namespace App\Http\Controllers\Api_v1\Clientes;
use App\Core\ControllerAbstract;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Facades\ClientesFacade;

class ClientesController extends ControllerAbstract
{

    private $_facadeCliente;

    public function __construct()
    {

        $this->_facadeCliente = new ClientesFacade();

    }

    public function index()
    {
        
        $clientes = $this->_facadeCliente->getAll();

        if($clientes->isEmpty()) {
            return response()->json([
                'message'   => 'Nenhum cliente encontrado',
            ], 404);
        }

        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = $this->_facadeCliente->findById($id);

        if(!$cliente) {
            return response()->json([
                'message'   => 'Nenhum cliente encontrado',
            ], 404);
        }

        return response()->json($cliente);
    }

    public function store(Request $request)
    {
        return response()->json($this->_facadeCliente->save($request), 201);
    }

    public function update(Request $request, $id)
    {

        $cliente = $this->_facadeCliente->update($request, $id);


    }







}
