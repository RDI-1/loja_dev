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

        if (!$clientes) {

            return response()->json([
                'informacoes' => [
                    'Nenhum cliente encontrado',
                ],

            ], 204);
        }

        return response()->json($clientes);
    }


    public function show($id)
    {
        $cliente = $this->_serviceCliente->findById($id);

        if (!$cliente) {
            return response()->json([
                'informacoes' => [
                    'Nenhum cliente encontrado',
                ],
            ], 204);
        }

        return response()->json($cliente);
    }


    public function store(ClienteRequest $request)
    {
        // var_dump($request->validated()); exit;

        if (!$request->validated()) {
            return response()->json(["validation_messages" => $request->errors()], 400);
        }

        try {

            return response()->json(["id" => $this->_serviceCliente->save($request)], 201);

        } catch (Exception $ex) {

            return response()->json($ex->getMessage(), 422);
        }

    }


    public function update(ClienteRequest $request, $id)
    {

        if ($request->fails()) {
            return response()->json(["validation_messages" => $request->errors()->toArray()], 400);
        }

        try {

            $request->pk_id_adm_cliente = $id;
            return response()->json(["id" => $this->_serviceCliente->save($request)], 200);

        } catch (Exception $ex) {

            return response()->json($ex->getMessage(), 422);
        }

    }

}
