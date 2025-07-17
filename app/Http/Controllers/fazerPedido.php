<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Categoria;
use App\Marca;
use App\Endereco;
use App\ItemCarrinho;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class fazerPedido extends Controller
{
    private $produtos;
    private $categorias;
    private $marcas;
    private $enderecos;
    private $itens;
    private $user_id;

    public function __construct()
    {
        $this->produtos = Produtos::all();
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            Log::debug('Session ID: ' . session()->getId());
            Log::debug('Auth check: ' . Auth::check());
            return $next($request);
        });
        Log::debug('Auth check:', [
            'isAuthenticated' => Auth::check(),
            'user_id' => Auth::id(),
            'user' => Auth::user(),
            'session' => session()->all(),
            'token' => csrf_token(),
            'headers' => request()->headers->all()
        ]);
        $this->user_id = auth()->id();
        dd($this->user_id);
        $this->enderecos = Endereco::where('user_id', auth()->id())->get();
    }
    public function index()
    {
        $enderecos = $this->enderecos;
        $itens = $this->queryBuilderItensCarrinho();
        return view('site.fazerPedido', compact('enderecos', 'itens'));
    }

    public function queryBuilderItensCarrinho()
    {
        $itens = DB::table('item_carrinhos')
            ->join('carrinhos', 'item_carrinhos.carrinho_id', '=', 'carrinhos.id')
            ->join('produtos', 'item_carrinhos.produto_id', '=', 'produtos.id')
            ->leftJoin('fotos', 'produtos.id', '=', 'fotos.produto_id')
            ->where('carrinhos.user_id', $this->user_id)
            ->where('carrinhos.status', 'ativo')
            ->select(
                'item_carrinhos.*',
                'produtos.nome as produto_nome',
                'produtos.valor as produto_valor',
                'fotos.url_imagem as produto_imagem'
            )
            ->get()
            ->groupBy('id');
        // Agrupa para evitar duplicatas
        return $itens;
    }
}
