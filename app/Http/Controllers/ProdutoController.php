<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\{Produto, Estoque, Avaliacao};

class ProdutoController extends Controller
{

    private $produtos;
    private $estoque;
    private $produtosDaMesmaCategoria;
    public function __construct()
    {
        $this->produtos = Produto::all();
        $this->estoque = Estoque::all();
    }


    public function index(Request $request, $id)  // Adicione Request $request como parâmetro
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()->route('site.principal');
        }

        $estoque = Estoque::where('produto_id', $id)->first();

        $produtosDaMesmaCategoria = Produto::where('categoria_id', $produto->categoria_id)
            ->where('id', '!=', $id)
            ->paginate(6);

        // Verifica se é uma requisição AJAX
        if ($request->ajax()) {
            $avaliacoes = $produto->avaliacao()
                ->orderBy('created_at', 'desc')
                ->paginate(4);

            return view('site.layouts._pages.produtos.avaliacoes', compact('avaliacoes'))->render();
        }

        // Carrega normalmente se não for AJAX
        $avaliacoes = $produto->avaliacao()
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('site.produto', compact('produto', 'estoque', 'produtosDaMesmaCategoria', 'avaliacoes'));
    }

}
