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
        $user_id = auth()->id() ?? 1;

        $carrinho = Carrinho::firstOrCreate(['user_id' => $user_id]);

        try {
            $produto = Produtos::findOrFail($request->produto_id);
            $estoque = new Estoque;
            $estoqueProduto = $estoque->listarEstoque($produto->id);
            $tamanho = $request->input('tamanho');
            $quantidadeSolicitada = $request->input('quantidade', 1);

            if (!$estoqueProduto) {
                return response()->json(['status' => 'error', 'message' => 'Produto sem estoque.']);
            }


            // Validação por tamanho
            switch ($tamanho) {
                case "P":
                    if ($estoqueProduto->quantidadeP < $quantidadeSolicitada) return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                    $estoqueProduto->quantidadeP -= $quantidadeSolicitada;
                    break;
                case "M":
                    if ($estoqueProduto->quantidadeM < $quantidadeSolicitada) return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                    $estoqueProduto->quantidadeM -= $quantidadeSolicitada;
                    break;
                case "G":
                    if ($estoqueProduto->quantidadeG < $quantidadeSolicitada) return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                    $estoqueProduto->quantidadeG -= $quantidadeSolicitada;
                    break;
                case "GG":
                    if ($estoqueProduto->quantidadeGG < $quantidadeSolicitada) return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                    $estoqueProduto->quantidadeGG -= $quantidadeSolicitada;
                    break;
                case "8":
                    if ($estoqueProduto->quantidade8 < $quantidadeSolicitada) return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                    $estoqueProduto->quantidade8 -= $quantidadeSolicitada;
                    break;
                case "825":
                    if ($estoqueProduto->quantidade825 < $quantidadeSolicitada) return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                    $estoqueProduto->quantidade825 -= $quantidadeSolicitada;
                    break;
                case "85":
                    if ($estoqueProduto->quantidade85 < $quantidadeSolicitada) return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                    $estoqueProduto->quantidade85 -= $quantidadeSolicitada;
                    break;
                default:
                    return response()->json(['status' => 'error', 'message' => 'Tamanho inválido!']);
            }

            // Atualiza o estoque total
            $estoqueProduto->quantidade -= $quantidadeSolicitada;
            $estoqueProduto->save();

            // Verifica se item igual já existe no carrinho com mesmo tamanho
            $itemExistente = ItemCarrinho::where('carrinho_id', $carrinho->id)
                ->where('produto_id', $produto->id)
                ->where('tamanho', $tamanho)
                ->first();

            if ($itemExistente) {
                $itemExistente->quantidade += $quantidadeSolicitada;
                $itemExistente->preco_total = $itemExistente->quantidade * $itemExistente->preco_unitario;
                $itemExistente->save();
            } else {
                ItemCarrinho::create([
                    'carrinho_id' => $carrinho->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $quantidadeSolicitada,
                    'preco_unitario' => $produto->valor,
                    'preco_total' => $produto->valor * $quantidadeSolicitada,
                    'tamanho' => $tamanho
                ]);
            }

            return response()->json(['status' => 'sucess', 'message' => 'Produto adicionado ao carrinho!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
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
            $user_id = auth()->id() ?? 1;
            $item_id = $request->item_id;
            $nova_quantidade = (int) $request->quantidade;
            $tamanho = $request->tamanho;

            // Busca o item do carrinho
            $item = ItemCarrinho::whereHas('carrinho', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
                ->where('id', $item_id)
                ->firstOrFail();

            $quantidadeAtual = $item->quantidade;
            $diferenca = $nova_quantidade - $quantidadeAtual;

            if ($diferenca === 0) {
                return response()->json(['status' => 'success']);
            }

            $estoque = Estoque::where('produto_id', $item->produto_id)->firstOrFail();

            // Mapeia o campo correto conforme o tamanho
            $mapaTamanho = [
                'P' => 'quantidadeP',
                'M' => 'quantidadeM',
                'G' => 'quantidadeG',
                'GG' => 'quantidadeGG',
                '775' => 'quantidade775',
                '8' => 'quantidade8',
                '825' => 'quantidade825',
                '85' => 'quantidade85',
            ];

            if (!array_key_exists($tamanho, $mapaTamanho)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tamanho inválido!'
                ]);
            }

            $campoTamanho = $mapaTamanho[$tamanho];

            // Se estiver aumentando a quantidade no carrinho
            if ($diferenca > 0) {
                if ($estoque->$campoTamanho < $diferenca) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Quantidade indisponível em estoque'
                    ]);
                }

                // Desconta do estoque
                $estoque->$campoTamanho -= $diferenca;
                $estoque->quantidade -= $diferenca;
            } elseif ($diferenca < 0) {
                // Se estiver diminuindo, devolve ao estoque
                $repor = abs($diferenca);
                $estoque->$campoTamanho += $repor;
                $estoque->quantidade += $repor;
            }

            $estoque->save();

            // Atualiza o item no carrinho
            $item->quantidade = $nova_quantidade;
            $item->preco_total = $item->preco_unitario * $nova_quantidade;
            $item->save();

            // Calcula totais
            $carrinho = $item->carrinho;
            $subtotal = $carrinho->itens->sum('preco_total');
            $taxa = $subtotal * 0.03;

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
            $user_id = auth()->id() ?? 1; // Fallback para teste
            $item_id = $request->item_id;

            // Busca o item do carrinho
            $item = ItemCarrinho::whereHas('carrinho', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->where('id', $item_id)->firstOrFail();

            // Remove o item do carrinho
            $item->delete();
            // Recalcula os valores do carrinho
            $carrinho = Carrinho::where('user_id', $user_id)->first();
            $subtotal = $carrinho ? $carrinho->itens->sum('preco_total') : 0;
            $taxa = $subtotal * 0.21;

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
