<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Produto, Fotos, Carrinho, ItemCarrinho, Categoria};
use Illuminate\Support\Facades\Auth;


class PrincipalController extends Controller
{
    public static function principal(Request $request)
    {

        if(Auth::check()){
            $cart = Carrinho::where('user_id', Auth::id())->first();
            if (!$cart) {
                $cart = Carrinho::create([
                    'user_id' => Auth::id(),
                    'status' => 'ativo'
                ]);
            }
            $itens = ItemCarrinho::where('carrinho_id', $cart->id)->get();
        }
        
        // Carrega todos os produtos COM suas fotos (eager loading)
        $produtos = Produto::with('fotos')->where('estado', 'ativo')->take(12)->get();
        dd($produtos);
        $produtoDestaque = $produtos->first();
        $categorias = Categoria::whereIn('nome', ['camisas', 'skates', 'tenis'])->get();
        $itens = $itens ?? [];
        $i = 0;
        $cart = $request->query('cart') == 1 ? 1 : null;
        return view('site.principal', compact('produtos', 'cart', 'itens','categorias', 'i', 'produtoDestaque'));
    }
}
