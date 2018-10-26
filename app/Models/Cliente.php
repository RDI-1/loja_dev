<?php

namespace App\Models;

use App\Core\ModelAbstract;

class Cliente extends ModelAbstract
{

    protected $table = 'clientes';
    protected $fillable = ['id, id_usuario'];

    public function usuario()
    {
        return $this->hasOne('App\Models\Usuario', 'id', 'id_usuario');
    }


}
