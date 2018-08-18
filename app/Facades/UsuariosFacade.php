<?php

namespace App\Facades;

use App\Core\FacadeAbstract;
use App\Models\Usuarios;
use Exception;
use DB;

class UsuariosFacade extends FacadeAbstract
{

    protected $_model;

    public function __construct(Usuarios $usuario)
    {
        $this->_model = $usuario;
    }

    public function save(Object $request)
    {

        try {

            if (isset($request->pk_id_adm_pessoa_usuario)) {
                return $this->update($request);
            }

            DB::beginTransaction();

            $this->_model->fill($request->all())->save();

            DB::commit();

            return $this->_model;

        } catch (Exception $e) {

            DB::rollBack();

            return [

                'errors' => [
                    'error_message' => 'Não foi possível realizar o cadastro do usuário',
                    'system_message' => $e->getMessage(),
                ],

            ];

        }

    }

    protected function update(Object $request)
    {

        try {

            $this->_model = $this->findById($request->pk_id_adm_pessoa_usuario);

            if (empty($this->_model->pk_id_adm_pessoa_usuario)) {
                return ['errors' => [
                    'Nenhum usuário encontrado',
                ]];
            }

            DB::beginTransaction();
            $this->_model->fill($request->all());
            $this->_model->save();
            DB::commit();
            
            return $this->_model;

        } catch (Exception $e) {

            DB::rollBack();

            return [
                'errors' => [
                    'error_message' => 'Não foi possível atualizar o registro do usuário',
                    'system_message' => $e->getMessage(),
                ],
            ];

        }

    }

    public function findById(int $id)
    {
        return $this->_model::find($id);
    }


}