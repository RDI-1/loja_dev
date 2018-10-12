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

    public function save($request)
    {
        
        if (isset($request->pk_id_adm_pessoa_usuario)) {
            return $this->update($request);
        }

        $this->_model->fill($request->all())->save();

        return $this->_model->pk_id_adm_pessoa_usuario;

    }

    private function update($request)
    {

        $this->_model = $this->findById($request->pk_id_adm_pessoa_usuario);
        $this->_model->fill($request->all())->save();

        return $this->_model->pk_id_adm_pessoa_usuario;

    }

    public function findById(int $id)
    {
        return $this->_model::find($id);
    }

   




}
