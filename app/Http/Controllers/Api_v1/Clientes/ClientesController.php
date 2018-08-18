<?php

namespace App\Http\Controllers\Api_v1\Clientes;

use App\Core\ControllerAbstract;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Facades\ClientesFacade;

class ClientesController extends ControllerAbstract
{

    protected $_facadeCliente;

    public function __construct(ClientesFacade $facadeCliente)
    {

        $this->_facadeCliente = $facadeCliente;

    }
    

    public function index()
    {

        $clientes = $this->_facadeCliente->getAll();

        if ($clientes->isEmpty()) {
            
            return response()->json([
                'informacoes' => [
                    'Nenhum cliente encontrado',
                ],

            ], 404);
        }

        return response()->json($clientes);
    }


    public function show($id)
    {
        $cliente = $this->_facadeCliente->findById($id);

        if (!$cliente) {
            return response()->json([
                'informacoes' => [
                    'Nenhum cliente encontrado',
                ],
            ], 404);
        }

        return response()->json($cliente);
    }


    public function store(Request $request)
    {

        $cliente = $this->_facadeCliente->save($request);

        if (isset($cliente['errors'])) {
            return response()->json([
                'errors' => $cliente['errors'],
            ], 404);
        }

        return response()->json($cliente, 201);
    }


    public function update(Request $request, $id)
    {

        $request->pk_id_adm_cliente = $id;
        $cliente = $this->_facadeCliente->save($request);

        if (isset($cliente['errors'])) {
            return response()->json([
                'errors' => $cliente['errors']
            ], 404);
        }

        return response()->json($cliente, 200);
    }







}
