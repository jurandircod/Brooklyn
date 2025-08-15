<?php

use App\Model\Produto;
use Faker\Generator as Faker;

// Factory de Produto (mantida como está)
$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'descricao' => $faker->sentence,
        'categoria_id' => $faker->randomElement([1, 2, 3]),
        'user_id' => 1,
        'material' => $faker->word,
        'valor' => $faker->randomFloat(2, 10, 1000),
        'marca_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});



