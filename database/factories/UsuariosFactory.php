<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Usuarios::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cpf' => $faker->unique()->randomNumber,
        'cnpj' => $faker->unique()->randomNumber,
        'email' => $faker->unique()->safeEmail,
        'celular' => $faker->phoneNumber,
        'telefone' => $faker->phoneNumber,
        'senha' => $faker->password
    ];
});
