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

            return [

                'errors' => [
                    'error_message' => 'Não foi possível realizar o cadastro do cliente',
                    'system_message' => $e->getMessage(),
                ],

            ];

        }

    }

    protected function update(Object $request)
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
            $request->pk_id_adm_pessoa_usuario = $this->_model->fk_id_adm_pessoa_usuario;
            $usuario = $this->_facadeUsuario->save($request);
            unset($this->_model->usuario);

            DB::commit();

            return [
                'cliente' => $this->_model,
                'usuario' => $usuario,
            ];

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

    public function getAll()
    {
        $usuarios = $this->_model::with('usuario')->get();
    
    }

    public function findById(int $id)
    {
        return $this->_model::with('usuario')->get()->find($id);
    }



}
