<?php

namespace App\Http\Requests;

use App\Core\RequestAbstract;

class ClienteRequest extends RequestAbstract
{


    public function authorize()
    {

        return true;

    }

    public function rules()
    {
        return [
            'nome' => 'required',
            'cpf' => 'unique:usuarios,cpf',
            'email' => 'unique:usuarios,email',
            'senha' => 'required',
        ];

    }

    // public function messages()
    // {

    //     return [
    //         'required' => 'Campo Obrigatório',
    //         // 'cpf.unique' => 'Já existe um usuário com este CPF.',
    //         'email.unique' => 'Já existe um usuário com este Email.',
    //     ];

    // }



}
