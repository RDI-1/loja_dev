<?php

namespace App\Http\Requests;

use App\Core\RequestAbstract;
use App\services\ClientesService;

class ClienteRequest extends RequestAbstract
{

    public function rules()
    {

        $cliente = isset($this->cliente) ? (new ClientesService())->findById($this->cliente) : null;
        $id = isset($cliente->id_usuario) ? $cliente->id_usuario : 0;

        return [
            'nome' => 'max:254|required',
            'cpf' => "max:100|unique:usuarios,cpf,{$id}",
            'cnpj' => "max:100|unique:usuarios,cnpj,{$id}",
            'email' => "max:200|email|required|unique:usuarios,email,{$id}",
            'celular' => "max:80|unique:usuarios,celular,{$id}",
            'telefone' => "max:80|unique:usuarios,telefone,{$id}",
            'password' => 'max:200|required',
        ];

    }


}
