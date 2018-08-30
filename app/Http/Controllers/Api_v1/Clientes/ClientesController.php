<?php

namespace App\Http\Controllers\Api_v1\Clientes;

use App\Core\ControllerAbstract;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Services\ClientesService;

class ClientesController extends ControllerAbstract
{

    protected $_ServiceCliente;

    public function __construct(ClientesService $ServiceCliente)
    {
        $this->_ServiceCliente = $ServiceCliente;
    }


    public function index()
    {

        $clientes = $this->_ServiceCliente->getAll();

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
        $cliente = $this->_ServiceCliente->findById($id);

        if (!$cliente) {
            return response()->json([
                'informacoes' => [
                    'Nenhum cliente encontrado',
                ],
            ], 204);
        }

        return response()->json($cliente);
    }


    public function store(Request $request)
    {

        $cliente = $this->_ServiceCliente->save($request);

        if (isset($cliente['errors'])) {
            return response()->json([
                'errors' => $cliente['errors'],
            ], 422);
        }

        return response()->json($cliente, 201);
    }


    public function update(Request $request, $id)
    {
        $request->pk_id_adm_cliente = $id;
        $cliente = $this->_ServiceCliente->save($request);

        if (isset($cliente['errors'])) {
            return response()->json([
                'errors' => $cliente['errors']
            ], 422);
        }

        return response()->json($cliente, 200);
    }


}
