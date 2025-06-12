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
    public function principal(Request $request){
        $produtos = $this->produtos;
        $fotos = $this->fotos;
        dd($fotos);
        if($request->query('cart') == 1){
            $cart = $request->query('cart');
            return view('site.principal', compact('produtos'))->with(['cart' => $cart]);
        }else{
            $cart = null;
            return view('site.principal', compact('produtos', 'fotos'))->with(['cart' => $cart]);
        }   
    }
}
