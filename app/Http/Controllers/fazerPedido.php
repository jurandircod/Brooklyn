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
    }
    public function index()
    {
        $this->enderecos = Endereco::where('user_id', auth()->id())->get();
        $enderecos = $this->enderecos;
        $itens = $this->queryBuilderItensCarrinho();
        $preco_total = 0;
        foreach ($itens as $item) {
            $preco_total += $item->preco_total;
        }
        $contador = 0;
        foreach ($itens as $item) {
            $contador += 1;
        }
        return view('site.fazerPedido', compact('enderecos', 'itens', 'preco_total', 'contador'));
    }

    public function queryBuilderItensCarrinho()
    {
        $itens = DB::table('item_carrinhos')->join('carrinhos', 'item_carrinhos.carrinho_id', '=', 'carrinhos.id')->join('produtos', 'item_carrinhos.produto_id', '=', 'produtos.id')->leftJoin('fotos', 'produtos.id', '=', 'fotos.produto_id')->where('carrinhos.user_id', auth()->id())->where('carrinhos.status', 'ativo')->select('item_carrinhos.*', 'produtos.nome as produto_nome', 'produtos.valor as produto_valor', 'fotos.url_imagem as produto_imagem')->get();
        // Agrupa para evitar duplicatas
        return $itens;
    }
}
