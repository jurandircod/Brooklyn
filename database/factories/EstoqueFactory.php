<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estoque;
use Faker\Generator as Faker;


// Factory de Estoque modificada
$factory->define(Estoque::class, function (Faker $faker) {
    return [
        'quantidade' => $faker->numberBetween(1, 100),
        'quantidadeP' => $faker->numberBetween(1, 100),
        'quantidadeM' => $faker->numberBetween(1, 100),
        'quantidadeG' => $faker->numberBetween(1, 100),
        'quantidadeGG' => $faker->numberBetween(1, 100),
        'quantidade775' => $faker->numberBetween(1, 100),
        'quantidade8' => $faker->numberBetween(1, 100),
        'quantidade825' => $faker->numberBetween(1, 100),
        'quantidade85' => $faker->numberBetween(1, 100),
        'produto_id' => null, // Será definido quando chamado pela factory de Fotos
        'created_at' => now(),
        'updated_at' => now(),
    ];
});