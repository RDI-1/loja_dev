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

    public function save(Object $request)
    {

        if (isset($request->pk_id_adm_pessoa_usuario) && $request->pk_id_adm_pessoa_usuario != null) {
            return $this->update($request);
        }

        $this->_model->fill($request->all());
        $this->_model->save();

        return $this->_model;


        return [
            'error_message' => 'Ocorreu um erro ao tentar salvar registro.',
            'error' => $ex->getMessage(),
        ];

    }


    public function findById(int $id)
    {
        return $this->_model::find($id);
    }

    public function update(Object $request)
    {

        $this->_model = $this->findById($request->pk_id_adm_pessoa_usuario);

        if (empty($this->_model->pk_id_adm_pessoa_usuario)) {
            return ['error' => 'Nenhum usuário encontrado'];
        }

        $this->_model->fill($request->all());
        $this->_model->save();

        return $this->_model;


    }


}