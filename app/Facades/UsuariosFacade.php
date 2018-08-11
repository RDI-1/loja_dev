<?php

namespace App\Facades;

use App\Core\FacadeAbstract;
use App\Models\Usuarios;

class UsuariosFacade extends FacadeAbstract
{

    private $_model;

    public function __construct()
    {

        $this->_model = new Usuarios();

    }

    public function save($request)
    {

        $this->_model->fill($request->all());
        $this->_model->save();
        return $this->_model;

    }



}