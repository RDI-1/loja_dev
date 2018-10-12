<?php

namespace App\Http\Controllers\api_v1\Clientes;

use App\Core\ControllerAbstract;
use Exception;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;
use App\Services\ClientesService;

class ClientesController extends ControllerAbstract
{

    protected $_serviceCliente;

    public function __construct(ClientesService $serviceCliente)
    {
        $this->_serviceCliente = $serviceCliente;
    }


    public function index()
    {
        $clientes = $this->_serviceCliente->getAll();
        return !$clientes->isEmpty() ? response()->json($clientes) : response()->json([], 204);
    }


    public function show($id)
    {
        $cliente = $this->_serviceCliente->findById($id);
        return $cliente ? response()->json($cliente) : response()->json([], 204);
    }


    public function store(ClienteRequest $request)
    {

        try {

            return response()->json(["id" => $this->_serviceCliente->save($request)], 201);

        } catch (Exception $ex) {

            return response()->json($ex->getMessage(), 422);
        }

    }


    public function update(ClienteRequest $request, $id)
    {

        try {

            return response()->json(["id" => $this->_serviceCliente->save($request, $id)], 200);

        } catch (Exception $ex) {

            return response()->json($ex->getMessage(), 422);
        }

    }

}
