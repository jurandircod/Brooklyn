<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use App\Pedido;
use App\User;

$factory->define(Pedido::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'endereco_id' => null,
        'status' => 'aguardando',
        'preco_total' => 100,
        'metodo_pagamento' => 'cartao',
        'data_pagamento' => now(),
        'status_pagamento' => 'pendente',
        'codigo_rastreio' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
