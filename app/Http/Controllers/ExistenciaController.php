<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrinho;
use App\ItemCarrinho;
use App\Produtos;
use App\Estoque;
use Illuminate\Support\Facades\Auth;

class ExistenciaController extends Controller
{
    
    public static function itemExiste($item_id)
    {
        $item = ItemCarrinho::find($item_id);
        if (!$item) {
            throw new \Exception("Item não encontrado ou deletado");
        }
    }

    public static function carrinhoExiste($user_id)
    {
        $carrinho = Carrinho::where('user_id', $user_id)->first();
        if (!$carrinho) {
            throw new \Exception("Carrinho não encontrado ou deletado");
        }
    }

    public static function estoqueExiste($produto_id)
    {
        $estoque = Estoque::where('produto_id', $produto_id)->first();
        if (!$estoque) {
            throw new \Exception("Estoque não encontrado ou deletado");
        }
    }

    public static function produtoExiste($produto_id)
    {
        $produto = Produtos::find($produto_id);
        if (!$produto) {
            throw new \Exception("Produto não encontrado ou deletado");
        }
    }
}
