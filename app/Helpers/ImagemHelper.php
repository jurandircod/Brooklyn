<?php

namespace App\Helpers;

use App\Fotos;
use Illuminate\Support\Facades\File;

class ImagemHelper
{
    public static function imagemDoProduto($idProduto)
    {
        $foto = Fotos::where('produto_id', $idProduto)->first();

        if (!$foto) {
            return asset('images/default-product.png');
        }

        $caminhoRelativo = $foto->url_imagem;
        $caminhoAbsoluto = public_path($caminhoRelativo);

        if (is_dir($caminhoAbsoluto)) {
            $arquivos = scandir($caminhoAbsoluto);
            $imagens = array_filter($arquivos, function ($arquivo) {
                return in_array(strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
            });

            if (!empty($imagens)) {
                $primeiraImagem = reset($imagens);
                return asset($caminhoRelativo . '/' . $primeiraImagem);
            }
        }

        if (file_exists($caminhoAbsoluto)) {
            return asset($caminhoRelativo);
        }

        return asset('images/default-product.png');
    }

    public static function pastaImagensProduto($idProduto){
        $foto = Fotos::where('produto_id', $idProduto)->first();

        if (!$foto) {
            return asset('images/default-product.png');
        }

        $caminhoRelativo = $foto->url_imagem;
        $caminhoAbsoluto = public_path($caminhoRelativo);

        return $caminhoAbsoluto;
    }
    
}
