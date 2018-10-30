<?php

namespace App\services;

use App\Core\ServiceAbstract;
use App\Models\Cliente;
use App\Services\UsuariosService;
use Exception;
use DB;

class ClientesService extends ServiceAbstract
{

    private $_model;
    private $_serviceUsuario;


    public function __construct()
    {

        $this->_model = new Cliente();
        $this->_serviceUsuario = new UsuariosService();

    }

    public function save($request, $id = null)
    {
        if ($id) {
            return $this->update($request, $id);
        }

        try {

            DB::beginTransaction();

            $this->_model->usuario_id = $this->_serviceUsuario->save($request);
            $this->_model->save();

            DB::commit();

            return $this->_model->id;

        } catch (Exception $ex) {

            DB::rollBack();

            throw $ex;

        }

    }

    private function update($request, $id)
    {
        try {
            $this->_model = $this->findById($id);
            DB::beginTransaction();

            $this->_model->fill($request->all())->save();
            $this->_serviceUsuario->save($request, $this->_model->usuario_id);

            DB::commit();

            return $this->_model->id;

        } catch (Exception $ex) {

            DB::rollBack();
            throw $ex;

        }

    }

    public function getAll(array $params = [])
    {
        return $this->_model::with('usuario')->get();
    }

    public function findById(int $id)
    {
        return $this->_model::with('usuario')->get()->find($id);
    }

    public function delete($id)
    {
        try {

            $this->_model = $this->findById($id);

            DB::beginTransaction();

            $this->_serviceUsuario->delete($this->_model->usuario_id);
            $this->_model->delete();

            DB::commit();

        } catch (Exception $ex) {

            DB::rollBack();
            throw $ex;

        }

    }


}
