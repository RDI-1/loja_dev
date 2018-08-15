<?php

namespace App\Facades;

use App\Core\FacadeAbstract;
use App\Models\Clientes;
use App\Models\Usuarios;
use App\Facades\UsuariosFacade;

class ClientesFacade extends FacadeAbstract
{

    private $_model;

    public function __construct()
    {

        $this->_model = new Clientes();
        $this->_facadeUsuario = new UsuariosFacade();

    }

    public function getAll()
    {
        return $this->_model::with('usuario')->get();
    }

    public function findById(int $id)
    {
        return $this->_model::with('usuario')->get()->find($id);
    }

    public function save(Object $request)
    {
        if (isset($request->pk_id_adm_cliente) && $request->pk_id_adm_cliente != null) {

            return $this->update($request);

        }

        $usuario = $this->_facadeUsuario->save($request);
        $this->_model->fk_id_adm_pessoa_usuario = $usuario->pk_id_adm_pessoa_usuario;
        $this->_model->save();

        return [
            'cliente' => $this->_model,
            'usuario' => $usuario,
        ];

    }

    public function update(Object $request)
    {

        $this->_model = $this->findById($request->pk_id_adm_cliente);

        if (empty($this->_model->pk_id_adm_cliente)) {
            return ['error' => 'Nenhum cliente encontrado'];
        }

        $this->_model->fill($request->all());
        $request->pk_id_adm_pessoa_usuario = $this->_model->fk_id_adm_pessoa_usuario;
        $usuario = $this->_facadeUsuario->save($request);

        return [
            'cliente' => $this->_model,
            'usuario' => $usuario,
        ];

    }


}
