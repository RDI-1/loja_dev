<?php

namespace App\Http\Requests;

use App\Core\RequestAbstract;
use Illuminate\Http\Request;
use Response;

class ClienteRequest extends RequestAbstract
{

    public function rules(Request $request)
    {
        $id = is_null($request->route('id')) ? 0 : $request->route('id');
        return [
            'nome' => 'required',
            'cpf' => "unique:usuarios,cpf," . $id,
            'email' => "unique:usuarios,email," . $id,
            'senha' => 'required',
        ];

    }

    public function messages()
    {

        return [
            'message' => 'ssasdasda',
            'required' => 'Campo Obrigatório',
            'cpf.unique' => 'Já existe um usuário com este CPF.',
            'email.unique' => 'Já existe um usuário com este Email.',
            'exists' => 'Your custom message',
        ];

    }




}
