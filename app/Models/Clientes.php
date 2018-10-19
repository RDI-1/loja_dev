<?php

namespace App\Models;

use App\Core\ModelAbstract;

class Clientes extends ModelAbstract
{

    protected $table = 'clientes';
    protected $fillable = ['id, usuarios_id'];

    public function usuario()
    {
        return $this->hasOne('App\Models\Usuarios', 'id', 'usuarios_id');
    }
    

}
