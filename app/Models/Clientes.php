<?php

namespace App\Models;

use App\Core\ModelAbstract;

class Clientes extends ModelAbstract
{

    protected $table = 'clientes';
    protected $fillable = ['id, id_usuario'];

    public function usuario()
    {
        return $this->hasOne('App\Models\Usuarios', 'id', 'id_usuario');
    }


}
