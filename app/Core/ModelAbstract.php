<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class ModelAbstract extends Model
{

    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    public $timestamps = true;

}
