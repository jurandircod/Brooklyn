<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Estoque;
use App\Avaliacao;

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
    public function index($id)
    {
        $produtos = $this->produtos->where('id', $id)->first();
        $estoque = $this->estoque->where('produto_id', $id)->first();
        if (!$estoque and !$produtos) {
            return redirect()->route('site.principal');
        }
        $produtosDaMesmaCategoria = $this->produtos->where('categoria_id', $produtos->categoria_id)->take(6);

        $produto = Produto::find($id);
        return view('site.produto', compact('produtos', 'produto', 'estoque', 'produtosDaMesmaCategoria'));
    }


}
