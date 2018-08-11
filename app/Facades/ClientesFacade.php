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

    public function findById($id)
    {
        return $this->_model::with('usuario')->get()->find($id);
    }

    public function save($request)
    {

        // lembrar de 
        //se o usuário estiver vazio, carrega o usuário atual para ser atualizado
        $usuario = $this->_facadeUsuario->save($request);

        $this->_model->fill(['fk_id_adm_pessoa_usuario' => $usuario->pk_id_adm_pessoa_usuario]);
        $this->_model->save();

        return [
            'cliente' => $this->_model,
            'usuario' => $usuario,
        ];

    }

    public function update(Request $request, $id)
    {

        $cliente = $this->findById($id);

        if ($cliente) {
            
            $cliente->fill($request->all());
            $this->save($cliente);

        }


        return response()->json($job);

    }



}
