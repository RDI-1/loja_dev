<?php

namespace App\Services;

use App\Core\ServiceAbstract;
use App\Models\Usuario;
use Exception;
use DB;
use Illuminate\Http\Request;

class UsuariosService extends ServiceAbstract
{

    private $_model;

    public function __construct()
    {
        $this->_model = new Usuario();
    }

    public function save($request, $id = null)
    {
        if ($id) {
            return $this->update($request, $id);
        }

        $this->_model->fill($request->all())->save();

        return $this->_model->id;
    }

    private function update($request, $id)
    {
        $this->_model = $this->findById($id);
        $this->_model->fill($request->all())->save();

        return $this->_model->id;

    }

    public function findById(int $id)
    {
        return $this->_model::find($id);
    }

    public function delete($id)
    {
        $this->findById($id)->delete();
    }






}
