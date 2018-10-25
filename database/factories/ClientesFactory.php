<?php

use Faker\Generator as Faker;
use App\Models\Usuarios;

$factory->define(App\Models\Clientes::class, function (Faker $faker) {


    return [
        'id_usuario' => function () {
            return factory(Usuarios::class)->create()->id;
        }
    ];

});
