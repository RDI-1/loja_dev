<?php

namespace App\Models;

use App\Core\ModelAbstract;

class Clientes extends ModelAbstract
{

    protected $table = 'adm_clientes';
    protected $primaryKey = 'pk_id_adm_cliente';
    protected $fillable = ['fk_id_adm_pessoa_usuario'];

    public function usuario()
    {
        return $this->hasOne('App\Models\Usuarios', 'pk_id_adm_pessoa_usuario', 'fk_id_adm_pessoa_usuario');
    }


}
