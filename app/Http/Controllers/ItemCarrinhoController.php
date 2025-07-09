<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrinho;
use App\ItemCarrinho;
use App\Produtos;
use App\Estoque;
use Illuminate\Support\Facades\Auth;

class ItemCarrinhoController extends Controller
{
    public function adicionar(Request $request)
    {


        $user_id = auth()->id() ?? 1; // ID de fallback

        // Busca ou cria o carrinho do usuário
        $carrinho = Carrinho::firstOrCreate(
            ['user_id' => $user_id],
        );

        try {

            $produto = Produtos::findOrFail($request->produto_id);
            $estoque = new Estoque;
            $estoqueProduto = $estoque->listarEstoque($produto->id);


            if (isset($estoqueProduto)) {
                // Verifica se o estoque está cheio
                if ($estoqueProduto->quantidade < $request->input('quantidade', 1)) {
                    // Se não estiver cheio, verifica se o estoque tem espaço
                    return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                }
            } else {
                // Se não tiver estoque, retorna erro
                return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
            }

            // Verifica se já existe o mesmo produto no carrinho
            $itemExistente = ItemCarrinho::where('carrinho_id', $carrinho->id)
                ->where('produto_id', $produto->id)
                ->first();

            if ($itemExistente) {
                // Atualiza a quantidade
                $itemExistente->quantidade += $request->input('quantidade', 1);
                $itemExistente->preco_total = $itemExistente->quantidade * $produto->valor;
                $itemExistente->save();
                return response()->json(['status' => 'sucess', 'message' => 'Produto adicionado ao carrinho!']);
                exit();
            } else {
                // Cria novo item
                ItemCarrinho::create([
                    'carrinho_id' => $carrinho->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $request->input('quantidade', 1),
                    'preco_unitario' => $produto->valor,
                    'preco_total' => $produto->valor,
                ]);
                return response()->json(['status' => 'sucess', 'message' => 'Produto adicionado ao carrinho!']);
                exit();
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => "$e"]);
        }
    }

    public function quantidadeItensCarrinho()
    {
        $carrinho = Carrinho::where('user_id', Auth::id())->first();

        if ($carrinho) {
            $quantidade = ItemCarrinho::where('carrinho_id', $carrinho->id)->count();
            return response()->json(['quantidade' => $quantidade]);
        }

        return response()->json(['quantidade' => 0]);
    }

    public function atualizarQuantidade(Request $request)
    {
        try {
            $user_id = auth()->id() ?? 1; // ID de fallback
            $item_id = $request->item_id;
            $nova_quantidade = $request->quantidade;

            // Busca o item do carrinho
            $item = ItemCarrinho::whereHas('carrinho', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
                ->where('id', $item_id)
                ->firstOrFail();

            // Verifica estoque
            $estoque = Estoque::where('produto_id', $item->produto_id)->first();
            if ($estoque && $estoque->quantidade < $nova_quantidade) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Quantidade indisponível em estoque'
                ]);
            }

            // Atualiza o item
            $item->quantidade = $nova_quantidade;
            $item->preco_total = $item->preco_unitario * $nova_quantidade;
            $item->save();

            // Calcula totais do carrinho
            $carrinho = $item->carrinho;
            $subtotal = $carrinho->itens->sum('preco_total');
            $taxa = $subtotal * 0.03; // Exemplo de 21% de taxa

            return response()->json([
                'status' => 'success',
                'item_total' => number_format($item->preco_total, 2, ',', '.'),
                'subtotal' => number_format($subtotal, 2, ',', '.'),
                'taxa' => number_format($taxa, 2, ',', '.'),
                'total' => number_format($subtotal + $taxa, 2, ',', '.')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar quantidade: ' . $e->getMessage()
            ]);
        }
    }

    public function removerItem(Request $request)
    {
        try {
            $user_id = auth()->id() ?? 1; // ID de fallback
            $item_id = $request->item_id;

            // Busca e remove o item do carrinho
            $item = ItemCarrinho::whereHas('carrinho', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
                ->where('id', $item_id)
                ->firstOrFail();

            $item->delete();

            // Calcula novos totais
            $carrinho = Carrinho::where('user_id', $user_id)->first();
            $subtotal = $carrinho ? $carrinho->itens->sum('preco_total') : 0;
            $taxa = $subtotal * 0.21; // Exemplo de 21% de taxa

            return response()->json([
                'status' => 'success',
                'message' => 'Item removido com sucesso',
                'subtotal' => number_format($subtotal, 2, ',', '.'),
                'taxa' => number_format($taxa, 2, ',', '.'),
                'total' => number_format($subtotal + $taxa, 2, ',', '.'),
                'quantidade_itens' => $carrinho ? $carrinho->itens->count() : 0
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao remover item: ' . $e->getMessage()
            ], 500);
        }
    }
}
