<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Carrinho;
use App\ItemCarrinho;

class CarrinhoController extends Controller
{

    private $carrinho;
    private $itens;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $this->carrinho = Carrinho::where('user_id', Auth::id())->first();
        $this->itens = ItemCarrinho::where('carrinho_id', $this->carrinho->id)->get();
        $carrinho = $this->carrinho;
        $itens = $this->itens;
        return view('site.carrinho', compact('carrinho', 'itens'));
    }
}
