<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Contato;

$factory->define(Contato::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'sobrenome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'telefone' => $faker->phoneNumber,
        'mensagem' => $faker->sentence,
        'status' => 'pendente'
    ];
});
