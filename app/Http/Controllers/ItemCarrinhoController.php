<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrinho;
use App\ItemCarrinho;
use App\Produto;
use App\Estoque;
use App\Http\Controllers\ExistenciaController;
use Illuminate\Support\Facades\Auth;


class ItemCarrinhoController extends Controller
{
    private $itemCarrinho;
    private $tamanhoMap = [
        0 => 'quantidadeP',
        1 => 'quantidadeM',
        2 => 'quantidadeG',
        3 => 'quantidadeGG',
        4 => 'quantidade775',
        5 => 'quantidade8',
        6 => 'quantidade825',
        7 => 'quantidade85',
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
            $verificaResposta = $this->AtualizaEstoque($tamanho, $estoqueProduto, $quantidadeSolicitada);

            
            if(!$verificaResposta){
                return response()->json(['status'=> 'error', 'message' => 'Estoque Indisponível']);
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

    private function AtualizaEstoque($tamanho, Estoque $estoqueProduto, $quantidadeSolicitada)
    {
        switch ($tamanho) {
            case "P":
                if ($estoqueProduto->quantidadeP < $quantidadeSolicitada) return false;
                $estoqueProduto->quantidadeP -= $quantidadeSolicitada;
                $estoqueProduto->quantidade -= $quantidadeSolicitada;

                break;
            case "M":
                if ($estoqueProduto->quantidadeM < $quantidadeSolicitada) return false;
                $estoqueProduto->quantidadeM -= $quantidadeSolicitada;
                $estoqueProduto->quantidade -= $quantidadeSolicitada;

                break;
            case "G":
                if ($estoqueProduto->quantidadeG < $quantidadeSolicitada) return false;
                $estoqueProduto->quantidadeG -= $quantidadeSolicitada;
                $estoqueProduto->quantidade -= $quantidadeSolicitada;

                break;
            case "GG":
                if ($estoqueProduto->quantidadeGG < $quantidadeSolicitada) return false;
                $estoqueProduto->quantidadeGG -= $quantidadeSolicitada;
                $estoqueProduto->quantidade -= $quantidadeSolicitada;

                break;
            case "8":
                if ($estoqueProduto->quantidade8 < $quantidadeSolicitada) return false;
                $estoqueProduto->quantidade8 -= $quantidadeSolicitada;
                $estoqueProduto->quantidade -= $quantidadeSolicitada;
                break;
            case "825":
                if ($estoqueProduto->quantidade825 < $quantidadeSolicitada) return false;
                $estoqueProduto->quantidade825 -= $quantidadeSolicitada;
                $estoqueProduto->quantidade -= $quantidadeSolicitada;
                break;
            case "85":
                if ($estoqueProduto->quantidade85 < $quantidadeSolicitada) return false;
                $estoqueProduto->quantidade85 -= $quantidadeSolicitada;
                $estoqueProduto->quantidade -= $quantidadeSolicitada;
                break;
            case "quantidade":
                if ($estoqueProduto->quantidade < $quantidadeSolicitada) {
                    return false;
                    break;
                    exit();
                }
                $estoqueProduto->quantidade -= $quantidadeSolicitada;
                //zera os estoques de outras categorias, caso tenha
                foreach ($this->tamanhoMap as $t) {
                    $estoqueProduto->$t = 0;
                };
                break;
            default:
                return false;
        }
        $estoqueProduto->save();
        return true;
    }

    public function quantidadeItensCarrinho()
    {
        $carrinho = Carrinho::where('user_id', Auth::id())->first();

        if ($carrinho) {
            $quantidade = ItemCarrinho::where('carrinho', function ($query) {
                $query->where('status', 'ativo')->where('user_id', Auth::id())->count();

            });
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

            if ($diferenca === 0) {
                return response()->json(['status' => 'success']);
            }

            ExistenciaController::estoqueExiste($item->produto_id);
            $estoque = Estoque::where('produto_id', $item->produto_id)->firstOrFail();

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
            if ($diferenca > 0) {
                if ($estoque->$campoTamanho < $diferenca) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Quantidade indisponível em estoque'
                    ]);
                }

                // Desconta do estoque
                $estoque->$campoTamanho -= $diferenca;
            } elseif ($diferenca < 0) {
                // Se estiver diminuindo, devolve ao estoque
                $repor = abs($diferenca);
                $estoque->$campoTamanho += $repor;
            }

            $estoque->save();

            // Atualiza o item no carrinho
            $item->quantidade = $nova_quantidade;
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
