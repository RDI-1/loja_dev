<?php

namespace App\Services;

use App\Core\ServiceAbstract;
use App\Models\Clientes;
use App\Services\UsuariosService;
use Exception;
use DB;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;


class ClientesService extends ServiceAbstract
{

    private $_model;
    private $_serviceUsuario;

    public function __construct(Clientes $cliente, UsuariosService $ServiceUsuario)
    {

        $this->_model = $cliente;
        $this->_serviceUsuario = $ServiceUsuario;
        
    }

    public function save($request)
    {

        if ($request->pk_id_adm_cliente) {
            return $this->update($request);
        }

        try {

            DB::beginTransaction();

            $this->_model->fk_id_adm_pessoa_usuario = $this->_serviceUsuario->save($request);
            $this->_model->save();

            DB::commit();

            return  $this->_model->pk_id_adm_cliente;

        } catch (Exception $ex) {

            DB::rollBack();

            throw $ex;

        }

    }

    private function update($request)
    {

        try {

            $this->findById($request->pk_id_adm_cliente);

            dd($this->_model);

            if (empty($this->_model->pk_id_adm_cliente)) {
               
                throw new Exception("Nenhum cliente encontrado para a atualização");

            }

            DB::beginTransaction();

            $this->_model->fill($request->all())->save();
            $this->_serviceUsuario->save($request);
             
            DB::commit();

            return $this->_model;

        } catch (Exception $e) {

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


}
