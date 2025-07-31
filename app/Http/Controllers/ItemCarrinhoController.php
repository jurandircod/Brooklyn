<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrinho;
use App\ItemCarrinho;
use App\Produto;
use App\Estoque;
use App\Http\Controllers\ExistenciaController;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Json;

class ItemCarrinhoController extends Controller
{
    private $itemCarrinho;
    private  $mapaTamanho = [
        'P' => 'quantidadeP',
        'M' => 'quantidadeM',
        'G' => 'quantidadeG',
        'GG' => 'quantidadeGG',
        '775' => 'quantidade775',
        '8' => 'quantidade8',
        '825' => 'quantidade825',
        '85' => 'quantidade85',
        'quantidade' => 'quantidade',
    ];

    public function __construct()
    {
        $this->itemCarrinho = new ItemCarrinho;
    }

    public function adicionar(Request $request)
    {

        try {
            $user_id = auth()->id();
            if (!$user_id) {
                throw new \Exception('Usuário não autenticado.');
                exit;
            }

            $carrinho = Carrinho::where('user_id', $user_id)->where('status', 'ativo')->first();
            if (!$carrinho) {
                $carrinho = Carrinho::create([
                    'user_id' => $user_id,
                    'status' => 'ativo'
                ]);
            }


            $produtoId = $request->produto_id;
            // verifica se o produto existe
            ExistenciaController::produtoExiste($request->produto_id);
            $produto = Produto::findOrFail($request->produto_id);
            $estoque = new Estoque;
            $estoqueProduto = $estoque->listarEstoque($produto->id);
            $tamanho = $request->input('tamanho');
            $quantidadeSolicitada = $request->input('quantidade');
            number_format($quantidadeSolicitada, 2, ',', '.');


            if (!$estoqueProduto) {
                return response()->json(['status' => 'error', 'message' => 'Produto sem estoque.']);
            }


            // Atualiza Estoque
            $verificaResposta = $this->verificaEstoque($tamanho, $estoqueProduto, $quantidadeSolicitada, $produtoId);

            if ($verificaResposta == 100) {
                return response()->json(['status' => 'error', 'message' => 'Tamanho inválido']);
            } elseif ($verificaResposta == 200) {
                return response()->json(['status' => 'error', 'message' => 'Quantidade no carrinho ultrapassa o estoque']);
            } elseif ($verificaResposta == 300) {
                return response()->json(['status' => 'error', 'message' => 'Estoque Indisponível']);
            }

            // Verifica se item igual já existe no carrinho com mesmo tamanho e se o carrinho está ativo
            $itemExistente = $this->itemCarrinho->VerificaItemCarrinho($carrinho->id, $produto->id, $tamanho);

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

            return response()->json(['status' => 'sucess', 'message' => ' produto adicionado ao carrinho!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function verificaEstoque($tamanho, Estoque $estoqueProduto, $quantidadeSolicitada, $produtoId)
    {

        if (!array_key_exists($tamanho, $this->mapaTamanho)) {
            return 100;
            exit;
        }

        $campoTamanho = $this->mapaTamanho[$tamanho];
        $carrinho = Carrinho::where('user_id', auth()->id())->where('status', 'ativo')->first();
        $itemCarrinho = ItemCarrinho::where('tamanho', $tamanho)->where('produto_id', $produtoId)->where('carrinho_id', $carrinho->id)->first();
        if (isset($itemCarrinho)) {
            $teste = $itemCarrinho->quantidade + $quantidadeSolicitada;
            if ($estoqueProduto->$campoTamanho < $teste) {
                return 200;
                exit;
            }
        }

        // se for menor que o estoque produto
        if ($estoqueProduto->$campoTamanho < $quantidadeSolicitada) {
            return 300;
            exit;
        }
    }

    public function quantidadeItensCarrinho()
    {
        $carrinho = Carrinho::where('user_id', Auth::id())->get();

        $quantidade = 0;

        if ($carrinho) {
            foreach ($carrinho as $carrinho) {
                if ($carrinho->status == 'ativo') {
                    $quantidade = ItemCarrinho::where('carrinho_id', $carrinho->id)->count();
                } else {
                    $quantidade = 0;
                }
            }
            return response()->json(['quantidade' => $quantidade]);
        }

        return response()->json(['quantidade' => 0]);
    }

    public function atualizarQuantidade(Request $request)
    {
        try {
            $user_id = auth()->id();
            $item_id = $request->item_id;
            // verifica se o produto existe
            ExistenciaController::itemExiste($item_id);

            //verifica se o produto existe
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
            $estoque = Estoque::where('produto_id', $item->produto_id)->firstOrFail();


            ExistenciaController::estoqueExiste($item->produto_id);

            // Mapeia o campo correto conforme o tamanho
            $mapaTamanho = [
                'P' => 'quantidadeP',
                'M' => 'quantidadeM',
                'G' => 'quantidadeG',
                'GG' => 'quantidadeGG',
                '7.75' => 'quantidade775',
                '8' => 'quantidade8',
                '8.25' => 'quantidade825',
                '8.5' => 'quantidade85',
                'quantidade' => 'quantidade',
            ];

            if (!array_key_exists($tamanho, $mapaTamanho)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tamanho inválido!'
                ]);
            }

            $campoTamanho = $mapaTamanho[$tamanho];

            // Se estiver aumentando a quantidade no carrinho
            if ($estoque->$campoTamanho < $nova_quantidade) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Quantidade indisponível em estoque'
                ]);
                exit;
            }


            if ($diferenca < 0) {
                // transforma o numero e positvo para restirar o item
                $item->quantidade = $quantidadeAtual - abs($diferenca);
            } else {
                $item->quantidade = $nova_quantidade;
            }
            // Atualiza o item no carrinho
            $item->preco_total = $item->preco_unitario * $nova_quantidade;
            $item->save();

            // Calcula totais
            $carrinho = $item->carrinho;
            $subtotal = $carrinho->itens->sum('preco_total');
            $taxa = $subtotal * 0.00;

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
            $user_id = auth()->id(); // Fallback para teste
            $item_id = $request->item_id;
            // verifica se o produto existe
            ExistenciaController::itemExiste($item_id);
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
