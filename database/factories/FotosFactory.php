<?php

use App\Model\{Fotos, Produto, Estoque};
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

$factory->define(Fotos::class, function (Faker $faker) {
    // Cria o produto
    $produto = factory(Produto::class)->create();

    if ($produto->categoria_id == 1) {
        $tamanho = ['p', 'm', 'g', 'gg'];
        $caminhoDownloads = "C:\Users\JURANDIR\Documents\Fotos Brooklyn\Camisas"; // usa barra normal no PHP

    } elseif ($produto->categoria_id == 2) {
        $tamanho = ['775', '8', '825', '85'];
        $caminhoDownloads = "C:\Users\JURANDIR\Documents\Fotos Brooklyn\Skates"; // usa barra normal no PHP

    } elseif ($produto->categoria_id == 3) {
        $caminhoDownloads = "C:\Users\JURANDIR\Documents\Fotos Brooklyn\Tenis"; // usa barra normal no PHP
        $tamanho = ['38', '39', '40', '41', '42'];
    } elseif ($produto->categoria_id == 4) {
        $caminhoDownloads = "C:\Users\JURANDIR\Documents\Fotos Brooklyn\Calcas";
        $tamanho = ['p', 'm', 'g', 'gg']; // usa barra normal no PHP
    }

    // Cria o estoque para o produto
    foreach ($tamanho as $tamanhoValue) {
        factory(Estoque::class)->create([
            'produto_id' => $produto->id,
            'tamanho' => $tamanhoValue,
        ]);
    }

    // Define o caminho base de downloads e destino
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

    // Copia/converte as imagens para o novo diretório
    $urlsImagens = [];
    foreach ((array) $imagensSelecionadas as $imagem) {
        $novoNome = $i++ . '.webp'; // agora sempre webp
        $novoCaminho = "{$caminhoDestino}/{$novoNome}";

        convertToWebp($imagem, $novoCaminho, 80);

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


/**
 * Converte uma imagem em WebP otimizando
 */
function convertToWebp(string $originalPath, string $webpPath, int $quality = 80)
{
    try {
        ini_set('memory_limit', '512M');
        $image = Image::make($originalPath);
        $image->orientate(); // corrige rotação

        // redimensiona se quiser limitar tamanho
        $image->resize(1200, 1200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // cria diretório se não existir
        $dir = dirname($webpPath);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        // encode webp
        $image->encode('webp', $quality)->save($webpPath);
        $image->destroy();

        return file_exists($webpPath);
    } catch (\Exception $e) {
        return false;
    }
}
