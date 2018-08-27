<?php

namespace App\Facades;

use App\Core\FacadeAbstract;
use App\Models\Clientes;
use App\Models\Usuarios;
use App\Facades\UsuariosFacade;
use Exception;
use DB;

class ClientesFacade extends FacadeAbstract
{

    protected $_model;
    protected $_facadeUsuario;

    public function __construct(Clientes $cliente, UsuariosFacade $facadeUsuario)
    {
        $this->_model = $cliente;
        $this->_facadeUsuario = $facadeUsuario;
    }

    public function save(Object $request)
    {

        $messages = [

            'errors' => [],
        ];

        if ($this->getAll(['cpf' => $request->cpf])->toArray()) {

            $messages['errors'][] = 'Não foi cadastrar este cliente, pois já existe um cliente com este CPF';
        }

        if ($this->getAll(['email' => $request->email])->toArray()) {

            $messages['errors'][] = 'Não foi cadastrar este cliente, pois já existe um cliente com este Email';
        }

        if ($messages['errors']) {
            return $messages;
        }


        try {

            if ($request->pk_id_adm_cliente) {
                return $this->update($request);
            }

            DB::beginTransaction();

            $usuario = $this->_facadeUsuario->save($request);
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


            $messages['errors']['error_message'] = 'Não foi possível realizar o cadastro do cliente';
            $messages['errors']['system_message'] = $e->getMessage();

            return $messages;
        }

    }

    private function update(Object $request)
    {

        try {


            $this->_model = $this->findById($request->pk_id_adm_cliente);

            if (empty($this->_model->pk_id_adm_cliente)) {

                return ['errors' => [
                    'Nenhum cliente encontrado para a atualização',
                ]];

            }

            DB::beginTransaction();

            $this->_model->fill($request->all());
            unset($this->_model->usuario);
            $request->pk_id_adm_pessoa_usuario = $this->_model->fk_id_adm_pessoa_usuario;
            $this->_model->usuario = $this->_facadeUsuario->save($request);

            DB::commit();

            return $this->_model;

        } catch (Exception $e) {

            DB::rollBack();

            return [

                'errors' => [
                    'error_message' => 'Não foi possível realizar o cadastro do cliente',
                    'system_message' => $e->getMessage(),
                ],

            ];

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
