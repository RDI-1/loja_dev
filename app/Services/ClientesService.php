<?php

namespace App\Services;

use App\Core\ServiceAbstract;
use App\Models\Clientes;
use App\Services\UsuariosService;
use Exception;
use DB;

class ClientesService extends ServiceAbstract
{

    private $_model;
    private $_ServiceUsuario;
    private $_response;

    public function __construct(Clientes $cliente, UsuariosService $ServiceUsuario)
    {
        $this->_model = $cliente;
        $this->_ServiceUsuario = $ServiceUsuario;
        $this->_response = [

            'errors' => [
                'error_messages' => [],
                'system_messages' => [],
            ],

        ];
    }

    public function save(Object $request)
    {

        if ($request->pk_id_adm_cliente) {
            return $this->update($request);
        }

        if ($this->getAll(['cpf' => $request->cpf])->toArray()) {
            $this->_response['errors']['error_messages'][] = 'Não foi cadastrar este cliente, pois já existe um cliente com este CPF';
        }

        if ($this->getAll(['email' => $request->email])->toArray()) {
            $this->_response['errors']['error_messages'][] = 'Não foi cadastrar este cliente, pois já existe um cliente com este Email';
        }

        if ($this->_response['errors']['error_messages']) {
            return $this->_response;
        }

        try {

            DB::beginTransaction();

            $usuario = $this->_ServiceUsuario->save($request);
            if (isset($usuario['errors'])) {
                return $usuario;
            }
            $this->_model->fk_id_adm_pessoa_usuario = $usuario->pk_id_adm_pessoa_usuario;
            $this->_model->save();

            DB::commit();

            return [
                'cliente' => $this->_model,
                'usuario' => $usuario,
            ];

        } catch (Exception $e) {

            DB::rollBack();

            $this->_response['errors']['error_messages'][] = 'Não foi possível realizar o cadastro do cliente';
            $this->_response['errors']['system_messages'][] = $e->getMessage();

            return $messages;
        }

    }

    private function update(Object $request)
    {

        try {

            $this->_model = $this->findById($request->pk_id_adm_cliente);

            if (empty($this->_model->pk_id_adm_cliente)) {

                $this->_response['errors']['error_messages'][] = 'Nenhum cliente encontrado para a atualização';
                return $this->_response;

            }

            DB::beginTransaction();

            $this->_model->fill($request->all());
            unset($this->_model->usuario);
            $request->pk_id_adm_pessoa_usuario = $this->_model->fk_id_adm_pessoa_usuario;
            $this->_model->usuario = $this->_ServiceUsuario->save($request);

            DB::commit();

            return $this->_model;

        } catch (Exception $e) {

            DB::rollBack();

            $this->_response['errors']['error_messages'][] = 'Não foi possível realizar o cadastro do cliente';
            $this->_response['errors']['system_messages'][] = $e->getMessage();

            return $this->_response;

        }

    }

    public function getAll(array $params = [])
    {
        $select = $this->_model::with('usuario')
            ->join('adm_pessoas_usuarios as u', 'u.pk_id_adm_pessoa_usuario', '=', 'adm_clientes.fk_id_adm_pessoa_usuario');

        if (isset($params['cpf']) && $params['cpf']) {
            $select->where('u.cpf', $params['cpf']);
        }

        if (isset($params['email']) && $params['email']) {
            $select->where('u.email', $params['email']);
        }

        return $select->get();
    }

    public function findById(int $id)
    {
        return $this->_model::with('usuario')->get()->find($id);
    }



}
