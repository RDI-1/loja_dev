<?php

namespace App\Core;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class RequestAbstract extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages()
    {

        return [
            'required' => 'Campo Obrigatório',
            'unique' => 'Já existe um usuário com este :attribute.',
        ];

    }

}