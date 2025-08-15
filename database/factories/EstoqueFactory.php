<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Estoque;
use Faker\Generator as Faker;


// Factory de Estoque modificada
$factory->define(Estoque::class, function (Faker $faker) {
    return [
        'quantidade' => $faker->numberBetween(1, 100),
        'tamanho' => null,
        'produto_id' => null, // Será definido quando chamado pela factory de Fotos
        'created_at' => now(),
        'updated_at' => now(),
    ];
});