<?php

namespace App\Services;

use App\Core\ServiceAbstract;
use App\Models\Usuarios;
use Exception;
use DB;
use Illuminate\Http\Request;

class UsuariosService extends ServiceAbstract
{

    private $_model;

    public function __construct(Usuarios $usuario)
    {
        $this->_model = $usuario;
    }

    public function save($request, $id = null)
    {
        if ($id) {
            return $this->update($request);
        }

        $this->_model->fill($request->all())->save();

        return $this->_model->id;
    }

    private function update($request)
    {

        $this->_model = $this->findById($request->id);
        $this->_model->fill($request->all())->save();

        return $this->_model->id;

    }

    public function findById(int $id)
    {
        return $this->_model::find($id);
    }






}
