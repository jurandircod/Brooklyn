<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Carrinho;
use App\ItemCarrinho;
use App\Produtos;

class CarrinhoController extends Controller
{

    private $carrinho;
    private $itens;
    private $produto;
    public function __construct()
    {
        $this->middleware('auth');
        $this->produto = Produtos::all();
    }
    public function index()
    {
        // pego o carrinho do usuario
        $this->carrinho = Carrinho::where('user_id', Auth::id())->first();
        // pego os itens do carrinho
        $this->itens = ItemCarrinho::where('carrinho_id', $this->carrinho->id)->get();
        // pego o produto do carrinho
        $produto = $this->produto;
        $carrinho = $this->carrinho;
        $itens = $this->itens;
        return view('site.carrinho', compact('carrinho', 'itens', 'produto'));
    }
}
