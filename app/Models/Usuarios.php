<?php

namespace App\Models;

use App\Core\ModelAbstract;

class Usuarios extends ModelAbstract
{

    protected $table = 'adm_pessoas_usuarios';
    protected $primaryKey = 'pk_id_adm_pessoa_usuario';
    protected $fillable = ['pk_id_adm_pessoa_usuario', 'nome', 'cpf', 'email', 'senha'];
    public $timestamps = true;

    public function cliente()
    {
        return $this->belongsTo('App\Models\Clientes');
    }


}
