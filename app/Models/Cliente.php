<?php

namespace App\Models;

use App\Core\ModelAbstract;

class Cliente extends ModelAbstract
{

    protected $table = 'clientes';
    protected $fillable = ['id, usuario_id'];

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario');
    }


}
