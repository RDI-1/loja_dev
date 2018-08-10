<?php

namespace App\Facades;

use App\Core\FacadeAbstract;
use App\Models\Clientes;

class ClientesFacade extends FacadeAbstract
{




    public function getAll()
    {
        return Clientes::with('usuario')->get();
    }




}
