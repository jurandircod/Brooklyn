<?php

namespace App\Helpers;

use App\Fotos;
use Illuminate\Support\Facades\File;

class ImagemHelper
{

    /**
     * Helper para pegar imagens do produto por posição
     * 
     * @param int $idProduto ID do produto
     * @param int $posicao Posição da imagem (0 para primeira, 1 para segunda, etc.)
     * @return string URL da imagem ou string vazia se não existir
     */
    public static function imagemDoProduto($idProduto, $posicao = 0)
    {
        // Busca o registro da pasta no banco de dados
        $foto = Fotos::where('produto_id', $idProduto)->first();

        if (!$foto) {
            // Retorna imagem padrão apenas para a primeira posição
            return $posicao === 0 ? asset('uploads/produtos/padrao/1.gif') : '';
        }

        $caminhoRelativo = $foto->url_imagem;
        $caminhoAbsoluto = public_path($caminhoRelativo);

        // Verifica se é um diretório válido
        if (!is_dir($caminhoAbsoluto)) {
            return $posicao === 0 ? asset('uploads/produtos/padrao/1.gif') : '';
        }

        // Lê os arquivos do diretório
        $arquivos = scandir($caminhoAbsoluto);

        // Filtra apenas imagens válidas
        $imagens = array_filter($arquivos, function ($arquivo) use ($caminhoAbsoluto) {
            // Ignora diretórios (. e ..) e verifica extensões
            $caminhoCompleto = $caminhoAbsoluto . '/' . $arquivo;
            if (is_dir($caminhoCompleto)) {
                return false;
            }

            // Verifica se o arquivo é uma imagem válida
            $ext = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
            return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        });

        // Ordena as imagens alfabeticamente
        sort($imagens);

        // Pega a imagem na posição solicitada
        $imagem = isset($imagens[$posicao]) ? $imagens[$posicao] : null;

        // Retorna a URL completa ou vazio se não existir
        return $imagem ? asset($caminhoRelativo . '/' . $imagem) : ($posicao === 0 ? asset('images/default-product.png') : '');
    }

    public static function pastaImagensMarca($idProduto)
    {
        $foto = Fotos::where('produto_id', $idProduto)->first();

        if (!$foto) {
            return asset('images/default-product.png');
        }

        $caminhoRelativo = $foto->url_imagem;
        $caminhoAbsoluto = public_path($caminhoRelativo);

        // Corrige as barras para o formato do Windows
        return str_replace('/', '\\', $caminhoAbsoluto);
    }

    public static function pastaImagensProduto($idProduto)
    {
        $foto = Fotos::where('produto_id', $idProduto)->first();

        if (!$foto) {
            return asset('images/default-product.png');
        }

        $caminhoRelativo = $foto->url_imagem;
        $caminhoAbsoluto = public_path($caminhoRelativo);

        return str_replace('/', '\\', $caminhoAbsoluto);
    }
}
