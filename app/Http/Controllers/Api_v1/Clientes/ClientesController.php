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
        return response()->json($this->_facadeCliente->getAll());
    }

}
