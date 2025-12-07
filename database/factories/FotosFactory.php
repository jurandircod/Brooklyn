<?php

namespace Database\Factories;

use App\Models\Fotos;
use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FotosFactory extends Factory
{
    protected $model = Fotos::class;

    public function definition(): array
    {
        // Cria produto
        $produto = Produto::factory()->create();

        $tamanho = [];
        $caminhoDownloads = null;

        if ($produto->categoria_id == 1) {
            $tamanho = ['p', 'm', 'g', 'gg'];
            $caminhoDownloads = 'C:/Users/JURANDIR/Documents/Fotos Brooklyn/Camisas';

        } elseif ($produto->categoria_id == 2) {
            $tamanho = ['775', '8', '825', '85'];
            $caminhoDownloads = 'C:/Users/JURANDIR/Documents/Fotos Brooklyn/Skates';

        } elseif ($produto->categoria_id == 3) {
            $tamanho = ['38', '39', '40', '41', '42'];
            $caminhoDownloads = 'C:/Users/JURANDIR/Documents/Fotos Brooklyn/Tenis';

        } elseif ($produto->categoria_id == 4) {
            $tamanho = ['p', 'm', 'g', 'gg'];
            $caminhoDownloads = 'C:/Users/JURANDIR/Documents/Fotos Brooklyn/Calcas';
        }

        // Cria estoque
        foreach ($tamanho as $tamanhoValue) {
            Estoque::factory()->create([
                'produto_id' => $produto->id,
                'tamanho' => $tamanhoValue,
            ]);
        }

        // Pasta destino
        $caminhoDestino = public_path("uploads/produtos/{$produto->id}");

        if (!File::exists($caminhoDestino)) {
            File::makeDirectory($caminhoDestino, 0755, true);
        }

        // Busca imagens
        $imagens = glob($caminhoDownloads . '/*.{png,jpg,jpeg,gif}', GLOB_BRACE);

        if (!$imagens) {
            return [
                'produto_id' => $produto->id,
                'url_imagem' => null,
            ];
        }

        // Seleciona até 5
        $imagensSelecionadas = array_slice($imagens, 0, min(count($imagens), 5));

        $urlsImagens = [];
        $i = 1;

        foreach ($imagensSelecionadas as $imagem) {
            $novoNome = $i++ . '.webp';
            $novoCaminho = "{$caminhoDestino}/{$novoNome}";

            $this->convertToWebp($imagem, $novoCaminho, 80);

            $urlsImagens[] = "/uploads/produtos/{$produto->id}/{$novoNome}";
        }

        return [
            'produto_id' => $produto->id,
            'url_imagem' => $this->faker->randomElement($urlsImagens),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function convertToWebp(string $originalPath, string $webpPath, int $quality = 80): bool
    {
        try {
            ini_set('memory_limit', '512M');

            $manager = new ImageManager(new Driver());

            $image = $manager->read($originalPath);

            $image->scaleDown(1200, 1200);

            $dir = dirname($webpPath);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            $image->toWebp($quality)->save($webpPath);

            return file_exists($webpPath);

        } catch (\Exception $e) {
            return false;
        }
    }
}
