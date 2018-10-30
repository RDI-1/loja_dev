<?php

use Faker\Generator as Faker;
use App\Models\Usuario;

$factory->define(App\Models\Cliente::class, function (Faker $faker) {


    return [
        'usuario_id' => function () {
            return factory(Usuario::class)->create()->id;
        }
    ];

});
