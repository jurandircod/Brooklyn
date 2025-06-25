<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Fotos;

class PrincipalController extends Controller
{

    private $produtos;
    private $fotos;
    private $cart;

    public function __construct()
    {
        $this->produtos = Produtos::all();
        $this->fotos = Fotos::all();
    }

    public function principal(Request $request)
    {
        $fotos = $this->fotos;
        // Carrega todos os produtos COM suas fotos (eager loading)
        $produtos = Produtos::with('fotos')->get();

        $caminhoRelativo = $fotos->where('produto_id', 15);

        $cart = $request->query('cart') == 1 ? 1 : null;

        return view('site.principal', compact('produtos', 'cart'));
    }


    public function produtosImagem($idProduto)
    {
        // Procura a pasta ou caminho da imagem
        $foto = $this->fotos->where('produto_id', $idProduto)->first();

        if (!$foto) {
            return asset('images/default-product.png'); // Fallback
        }

        $caminhoRelativo = $foto->url_imagem;
        $caminhoAbsoluto = public_path($caminhoRelativo);

        // Se for uma pasta
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

        // Se já for caminho direto de imagem
        if (file_exists($caminhoAbsoluto)) {
            return asset($caminhoRelativo);
        }

        return asset('images/default-product.png'); // fallback
    }
}
