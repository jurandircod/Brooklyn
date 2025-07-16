<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Estoque;

class ProdutoController extends Controller
{

    private $produtos;
    private $estoque;
    public function __construct()
    {
        $this->produtos = Produtos::all();
        $this->estoque = Estoque::all();
    }
    public function index($id)
    {
        $produtos = $this->produtos->where('id', $id)->first();
        $estoque = $this->estoque->where('produto_id', $id)->first();
        if(!$estoque and !$produtos){
            return redirect()->route('site.principal');
        }
        $produto = Produtos::find($id);
        return view('site.produto', compact('produtos', 'produto', 'estoque'));
    }
}
