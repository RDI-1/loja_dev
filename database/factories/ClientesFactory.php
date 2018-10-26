<?php

use Faker\Generator as Faker;
use App\Models\Usuario;

$factory->define(App\Models\Cliente::class, function (Faker $faker) {


    return [
        'id_usuario' => function () {
            return factory(Usuario::class)->create()->id;
        }
    ];

});
