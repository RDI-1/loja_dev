<?php

namespace App\Models;

use App\Core\ModelAbstract;

class Usuario extends ModelAbstract
{

    protected $table = 'usuarios';
    protected $fillable = ['id', 'nome', 'cpf', 'cnpj', 'email', 'celular', 'telefone', 'senha'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'id', 'id_usuario');
    }


}
