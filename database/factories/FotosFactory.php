<?php

use App\Model\{Fotos, Produto, Estoque};
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(Fotos::class, function (Faker $faker) {
    // Cria o produto
    $produto = factory(Produto::class)->create();

    if ($produto->categoria_id == 1) {
        $tamanho = [ 'p', 'm', 'g', 'gg'];
    }elseif ($produto->categoria_id == 2) {
        $tamanho = [ '775', '8', '825', '85'];
    }elseif ($produto->categoria_id == 3) {
        $tamanho = [ '38', '39', '40', '41', '42'];
    }

    // Cria o estoque para o produto
    foreach ($tamanho as $tamanhoValue) {
        factory(Estoque::class)->create([
            'produto_id' => $produto->id,
            'tamanho' => $tamanhoValue,        
        ]);
    }

    // Define o caminho base de downloads e destino
    $caminhoDownloads = "C:\Users\User\Documents\skate";
    $caminhoDestino = public_path("uploads/produtos/{$produto->id}");

    // Cria o diretório se não existir
    if (!File::exists($caminhoDestino)) {
        File::makeDirectory($caminhoDestino, 0755, true);
    }

    // Pega todas as imagens do diretório de downloads
    $imagens = glob($caminhoDownloads . '/*.{png,jpg,jpeg,gif}', GLOB_BRACE);

    // Seleciona 5 imagens aleatórias (ou menos se não houver 5)
    $imagensSelecionadas = array_rand(array_flip($imagens), min(5, count($imagens)));
    $i = 1;
    // Copia as imagens para o novo diretório
    $urlsImagens = [];
    foreach ((array)$imagensSelecionadas as $imagem) {
        $extensao = pathinfo($imagem, PATHINFO_EXTENSION);
        $novoNome = $i++ . '.' . $extensao; // Gera um nome único
        $novoCaminho = "{$caminhoDestino}/{$novoNome}";

        File::copy($imagem, $novoCaminho);
        $urlsImagens[] = "/uploads/produtos/{$produto->id}/";
    }

    // Retorna os dados para cada foto
    return [
        'produto_id' => $produto->id,
        'url_imagem' => $faker->randomElement($urlsImagens),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
