<?php
use App\Fotos;
use App\Produto;
use App\Estoque;
use Faker\Generator as Faker;

// Factory de Fotos modificada
$factory->define(Fotos::class, function (Faker $faker) {
    return [
        'url_imagem' => '/uploads/produtos/51/',
        'produto_id' => function () {
            // Cria o produto e retorna o ID
            $produto = factory(Produto::class)->create();
            
            // Cria o estoque para o mesmo produto
            factory(Estoque::class)->create([
                'produto_id' => $produto->id
            ]);
            
            return $produto->id;
        },
        'created_at' => now(),
        'updated_at' => now(),
    ];
});