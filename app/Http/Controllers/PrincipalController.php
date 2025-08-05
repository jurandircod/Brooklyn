<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\{Produto, Fotos, Carrinho, ItemCarrinho};
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
    
    public static function principal(Request $request)
    {
        $cart = Carrinho::where('user_id', Auth::id())->first();
       
        if (!$cart) {
            $cart = Carrinho::create([
                'user_id' => Auth::id(),
                'status' => 'ativo'
            ]);
        }
        $itens = ItemCarrinho::where('carrinho_id', $cart->id)->get();

        $fotos = Fotos::all();
        // Carrega todos os produtos COM suas fotos (eager loading)
        $produtos = Produto::with('fotos')->paginate(12);

        $itens = $itens;

        $cart = $request->query('cart') == 1 ? 1 : null;
        return view('site.principal', compact('produtos', 'cart', 'itens'));
    }
}
