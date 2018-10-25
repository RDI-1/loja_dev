<?php

namespace App\Http\Requests;

use App\Core\RequestAbstract;
use Illuminate\Http\Request;
use Response;

class ClienteRequest extends RequestAbstract
{

    //falta arrumar o unique do request
    public function rules(Request $request)
    {
        $id = is_null($request->route('cliente')) ? 0 : $request->route('cliente');
        return [
            'nome' => 'max:254|required',
            'cpf' => "max:100|unique:usuarios,cpf,{$id}",
            'cnpj' => "max:100|unique:usuarios,cnpj,{$id}",
            'email' => "max:200|email|required|unique:usuarios,email,{$id}",
            'senha' => 'max:200|required',
            'celular' => 'max:80',
            'telefone' => 'max:80',
        ];

    }


}
