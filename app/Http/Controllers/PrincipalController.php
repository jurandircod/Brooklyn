<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Fotos;
use App\Carrinho;
use App\ItemCarrinho;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrincipalController extends Controller
{

    private $produtos;
    private $fotos;
    private $cart;
    private $itens;
    private $user_id;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->produtos = Produto::all();
        $this->fotos = Fotos::all();
        // Em vez de auth()->id()
        //dd($user_id);
        //$this->itens = ItemCarrinho::where('carrinho_id', $this->cart->id)->get();
        
    }
    
    public function principal(Request $request)
    {
        $this->cart = Carrinho::where('user_id', Auth::id())->first();
        $this->itens = ItemCarrinho::where('carrinho_id', $this->cart->id)->get();

        $fotos = $this->fotos;
        // Carrega todos os produtos COM suas fotos (eager loading)
        $produtos = Produto::with('fotos')->take(12)->get();

        $itens = $this->itens;

        $cart = $request->query('cart') == 1 ? 1 : null;

        return view('site.principal', compact('produtos', 'cart', 'itens'));
    }
}
