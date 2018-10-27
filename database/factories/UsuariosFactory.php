<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Models\Usuario::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cpf' => $faker->unique()->randomNumber,
        'cnpj' => $faker->unique()->randomNumber,
        'email' => $faker->unique()->safeEmail,
        'celular' => $faker->phoneNumber,
        'telefone' => $faker->phoneNumber,
        'password' => Hash::make($faker->password),
    ];
});
