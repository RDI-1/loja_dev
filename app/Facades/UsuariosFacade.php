<?php

namespace App\Facades;

use App\Core\FacadeAbstract;
use App\Models\Usuarios;
use Exception;
use DB;

class UsuariosFacade extends FacadeAbstract
{

    private $_model;
    private $_response;

    public function __construct(Usuarios $usuario)
    {
        $this->_model = $usuario;
        $this->_response = [

            'errors' => [
                'error_messages' => [],
                'system_messages' => [],
            ],

        ];
    }

    public function save(Object $request)
    {

        if (isset($request->pk_id_adm_pessoa_usuario)) {
            return $this->update($request);
        }

        try {

            DB::beginTransaction();

            $this->_model->fill($request->all())->save();

            DB::commit();

            return $this->_model;

        } catch (Exception $e) {

            DB::rollBack();

            $this->_response['errors']['error_messages'][] = 'Não foi possível realizar o cadastro do usuário';
            $this->_response['errors']['system_messages'][] = $e->getMessage();

            return $this->_response;

        }

    }

    private function update(Object $request)
    {

        try {

            $this->_model = $this->findById($request->pk_id_adm_pessoa_usuario);

            if (empty($this->_model->pk_id_adm_pessoa_usuario)) {

                $this->_response['errors']['error_messages'][] = 'Nenhum usuário encontrado';
                return $this->_response;

            }

            DB::beginTransaction();
            $this->_model->fill($request->all());
            $this->_model->save();
            DB::commit();

            return $this->_model;

        } catch (Exception $e) {

            DB::rollBack();

            $this->_response['errors']['error_messages'][] = 'Não foi possível realizar o cadastro do usuário';
            $this->_response['errors']['system_messages'][] = $e->getMessage();

            return $this->_response;

        }

    }

    public function findById(int $id)
    {
        return $this->_model::find($id);
    }



}
