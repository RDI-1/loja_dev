<?php

namespace App\Http\Requests;

use App\Core\RequestAbstract;
use Response;
use Illuminate\Http\Request;
use App\Services\ClientesService;

class ClienteRequest extends RequestAbstract
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        $clienteService = new ClientesService();
        $cliente = $clienteService->findById($request->segment(3));
        dd($cliente);
        exit;
        return [
            'nome' => 'required',
            'cpf' => "unique:usuarios,cpf,9,id",
            'email' => "unique:usuarios,email,9,id",
            'senha' => 'required',
        ];

    }

    public function messages()
    {

        return [
            'required' => 'Campo Obrigatório',
            'cpf.unique' => 'Já existe um usuário com este CPF.',
            'email.unique' => 'Já existe um usuário com este Email.',
            'exists' => 'Your custom message',
        ];

    }



}
