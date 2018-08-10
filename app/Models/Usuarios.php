<?php

namespace App\Models;

use App\Core\ModelAbstract;

class Usuarios extends ModelAbstract
{

    protected $table = 'adm_pessoas_usuarios';
    protected $fillable = ['nome', 'cpf', 'email', 'senha'];


    public function cliente()
    {
        return $this->belongsTo('App\Models\Clientes');
    }


}
