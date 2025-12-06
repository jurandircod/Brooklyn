<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Produto, ItemCarrinho, Carrinho};

class CarrinhoController extends Controller
{

    private $carrinho;
    private $produto;
    public function __construct()
    {
        $this->middleware('auth');
        $this->produto = Produto::all();
    }

    
    public function index()
    {
        // pego o carrinho do usuario
        $this->carrinho = Carrinho::where('user_id', Auth::id())->where('status', 'ativo')->first();
        // pego os itens do carrinho
        $itens = ItemCarrinho::whereHas('carrinho', function ($query) {
            $query->where('status', 'ativo')->where('user_id', Auth::id());
        })->get();
        
        $preco_total = 0;
        foreach ($itens as $item) {
            $preco_total += $item->preco_total;
        }
        // pego o produto do carrinho
        $produto = $this->produto;
        $carrinho = $this->carrinho;
        return view('site.carrinho', compact('carrinho', 'itens', 'produto', 'preco_total'));
    }
}
