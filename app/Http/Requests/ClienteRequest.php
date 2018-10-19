<?php

namespace App\Http\Requests;

use App\Core\RequestAbstract;
use Illuminate\Http\Request;
use Response;

class ClienteRequest extends RequestAbstract
{

    public function rules(Request $request)
    {
        $id = is_null($request->route('cliente')) ? 0 : $request->route('cliente');
        return [
            'nome' => 'required',
            'cpf' => "required|unique:usuarios,cpf," . $id,
            'email' => "required|unique:usuarios,email," . $id,
            'senha' => 'required',
        ];

    }


}
