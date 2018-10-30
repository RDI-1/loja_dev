<?php

namespace App\Http\Requests;

use App\Core\RequestAbstract;
use App\services\ClientesService;

class ClienteRequest extends RequestAbstract
{

    public function rules()
    {
        return [
            'nome' => 'max:254|required',
            'cpf' => "max:100|unique:usuarios,cpf,$this->cliente",
            'cnpj' => "max:100|unique:usuarios,cnpj,$this->cliente",
            'email' => "max:200|email|required|unique:usuarios,email,$this->cliente",
            'celular' => "max:80|unique:usuarios,celular,$this->cliente",
            'telefone' => "max:80|unique:usuarios,telefone,$this->cliente",
            'password' => 'max:200|required',
        ];

    }


}
