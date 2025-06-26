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
        $produtos = Produtos::with('fotos')->take(12)->get();

        $caminhoRelativo = $fotos->where('produto_id', 15);

        $cart = $request->query('cart') == 1 ? 1 : null;

        return view('site.principal', compact('produtos', 'cart'));
    }

}
