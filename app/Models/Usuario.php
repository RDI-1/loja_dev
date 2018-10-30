<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{

    use HasApiTokens, Notifiable, SoftDeletes;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id', 'nome', 'cpf', 'cnpj', 'email', 'celular', 'telefone', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


}
