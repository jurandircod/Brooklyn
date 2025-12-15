<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Produto, User, Endereco, Carrinho, Estoque, ItemCarrinho, MapaTamanho};
use App\Http\Controllers\ExistenciaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ItemCarrinhoController extends Controller
{
    private $itemCarrinho;
    private $mapaTamanho;
    // Mantive caso use em outras partes, mas não mais necessário para frete
    private $calcularFrete;

    public function __construct()
    {
        $this->itemCarrinho = new ItemCarrinho;
        $this->mapaTamanho = new MapaTamanho;
        $this->calcularFrete = new \stdClass; // placeholder - removível
    }

    public function adicionar(Request $request)
    {
        try {
            $user_id = Auth::id();
            if (!$user_id) {
                throw new \Exception('Usuário não autenticado.');
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
            $tamanho = $request->input('tamanho');
            $estoqueProduto = Estoque::where('produto_id', $produto->id)->where('tamanho', $tamanho)->first();
            $quantidadeSolicitada = $request->input('quantidade');
            number_format($quantidadeSolicitada, 2, ',', '.');

            if (!$estoqueProduto) {
                return response()->json(['status' => 'error', 'message' => 'Produto sem estoque.']);
            }

            // Atualiza Estoque (verifica)
            $verificaResposta = $this->verificaEstoque($tamanho, $estoqueProduto, $quantidadeSolicitada, $produtoId);

            if ($verificaResposta == 100) {
                return response()->json(['status' => 'error', 'message' => 'Tamanho inválido']);
            } elseif ($verificaResposta == 200) {
                return response()->json(['status' => 'error', 'message' => 'Quantidade no carrinho ultrapassa o estoque']);
            } elseif ($verificaResposta == 300) {
                return response()->json(['status' => 'error', 'message' => "Estoque Indisponível"]);
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

            // Recalcula subtotal e frete (se usuário tiver endereço)
            $carrinho = Carrinho::where('user_id', $user_id)->where('status', 'ativo')->first();
            $subtotal = $carrinho->itens->sum('preco_total');

            $endereco = Endereco::where('user_id', $user_id)->first();
            if (!$endereco) {
                $taxaFrete = 0;
            } else {
                $freteData = $this->calcularFreteParaCarrinho($endereco->cep, $carrinho);
                $taxaFrete = floatval($freteData['valor']);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Produto adicionado ao carrinho!',
                'subtotal' => number_format($subtotal, 2, ',', '.'),
                'taxa' => number_format($taxaFrete, 2, ',', '.'),
                'total' => number_format($subtotal + $taxaFrete, 2, ',', '.')
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Verifica se o item que está sendo adicionado ao carrinho ultrapassa o estoque
     */
    private function verificaEstoque($tamanho, Estoque $estoqueProduto, $quantidadeSolicitada, $produtoId)
    {
        $carrinho = Carrinho::where('user_id', Auth::id())->where('status', 'ativo')->first();
        $itemCarrinho = ItemCarrinho::where('tamanho', $tamanho)->where('produto_id', $produtoId)->where('carrinho_id', $carrinho->id)->first();
        if (isset($itemCarrinho)) {
            $verificaQuantidade = $itemCarrinho->quantidade + $quantidadeSolicitada;
            if ($estoqueProduto->quantidade < $verificaQuantidade) {
                return 200;
            }
        }

        if ($estoqueProduto->quantidade < $quantidadeSolicitada) {
            return 300;
        }
    }

    public function quantidadeItensCarrinho()
    {
        $carrinho = Carrinho::where('user_id', Auth::id())->where('status', 'ativo')->first();

        $quantidade = 0;
        $ultimaModificacao = null;

        if ($carrinho && $carrinho->status == 'ativo') {
            $quantidade = ItemCarrinho::where('carrinho_id', $carrinho->id)->count();

            $ultimaModificacaoItem = ItemCarrinho::where('carrinho_id', $carrinho->id)
                ->latest('updated_at')
                ->value('updated_at');

            $ultimaModificacao = $ultimaModificacaoItem ?: $carrinho->updated_at;
        }

        return response()->json([
            'quantidade' => $quantidade,
            'ultima_modificacao' => $ultimaModificacao ? $ultimaModificacao->toDateTimeString() : null
        ]);
    }

    public function atualizarQuantidade(Request $request)
    {
        try {
            $user_id = Auth::id();
            $item_id = $request->item_id;
            // verifica se o produto existe
            ExistenciaController::itemExiste($item_id);

            //verifica se o produto existe
            $nova_quantidade = (int) $request->quantidade;
            $tamanho = $request->tamanho;

            // Busca o item do carrinho
            $item = $this->itemCarrinho->itemCarrinho($item_id, $user_id);

            $quantidadeAtual = $item->quantidade;
            $diferenca = $nova_quantidade - $quantidadeAtual;

            ExistenciaController::estoqueExiste($item->produto_id);
            // Mapeia o campo correto conforme o tamanho

            $tamanhoTratado = $this->mapaTamanho->getTamanhoDisponiveis($request->categoria_id, $tamanho);
            $estoque = Estoque::where('produto_id', $item->produto_id)->where('tamanho', $tamanhoTratado)->firstOrFail();
            if (!$estoque) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Contate o suporte para mais informações"
                ]);
            }
            // Se estiver aumentando a quantidade no carrinho
            if ($estoque->quantidade < $nova_quantidade) {
                return response()->json([
                    'status' => 'error',
                    'message' => "indisponível em estoque"
                ]);
            }

            if ($diferenca < 0) {
                // transforma o numero e positvo para retirar o item
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
            $endereco = Endereco::where('user_id', $user_id)->first();
            if (!$endereco) {
                $taxaFrete = 0;
            } else {
                $freteData = $this->calcularFreteParaCarrinho($endereco->cep, $carrinho);
                $taxaFrete = floatval($freteData['valor']);
            }

            return response()->json([
                'status' => 'success',
                'item_total' => number_format($item->preco_total, 2, ',', '.'),
                'subtotal' => number_format($subtotal, 2, ',', '.'),
                'taxa' => number_format($taxaFrete, 2, ',', '.'),
                'total' => number_format($subtotal + $taxaFrete, 2, ',', '.')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar quantidade: ' . $e->getMessage()
            ]);
        }
    }

    public function limpaCarrinho()
    {
        try {
            $carrinho = Carrinho::where('user_id', Auth::id())->where('status', 'ativo')->first();
            if(!$carrinho){
                Alert::warning('Carrinho vazio', 'Não há itens para limpar');
                return redirect()->route('site.carrinho');
            }
            $carrinho->itens()->delete();
            Alert::alert('Sucesso', 'Carrinho limpo com sucesso!', 'success');
            return redirect()->route('site.carrinho');
        } catch (\Exception $e) {
            Alert::error('Erro ao limpar carrinho: ' . $e->getMessage());
            return redirect()->route('site.carrinho');
        }
    }

    public function removerItem(Request $request)
    {
        try {
            $user_id = Auth::id();
            $item_id = $request->item_id;
            // verifica se o produto existe
            ExistenciaController::itemExiste($item_id);
            // Busca o item do carrinho
            $item = $this->itemCarrinho->itemCarrinho($item_id, $user_id);
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

    /**
     * Calcula o frete aproximado para todo o carrinho com base no CEP.
     * - Usa médias por categoria se a categoria tiver colunas avg_* na tabela categorias.
     * - Caso contrário, usa defaults internos (IDs: 1 Camisas, 2 Skates, 3 Tênis, 4 Calças).
     */
    private function calcularFreteParaCarrinho(string $cepRaw, Carrinho $carrinho): array
    {
        $cep = preg_replace('/\D/', '', $cepRaw);
        if (strlen($cep) < 3) {
            return ['valor' => 0.0, 'peso_cobrado' => 0.0, 'zona' => 'indefinida'];
        }

        // defaults por categoria
        $categoryDefaults = [
            1 => ['largura' => 30, 'altura' => 3,  'comprimento' => 30, 'peso' => 0.25], // Camisas
            2 => ['largura' => 24, 'altura' => 6,  'comprimento' => 80, 'peso' => 2.50], // Skates completos
            3 => ['largura' => 35, 'altura' => 12, 'comprimento' => 33, 'peso' => 1.20], // Tênis
            4 => ['largura' => 32, 'altura' => 4,  'comprimento' => 35, 'peso' => 0.50], // Calças
        ];

        $totalVolume = 0.0; // cm3
        $totalPesoReal = 0.0; // kg

        foreach ($carrinho->itens as $item) {
            $quant = max(1, intval($item->quantidade));
            $produto = Produto::find($item->produto_id);

            // tenta pegar médias da categoria no DB
            $catId = $produto->categoria_id ?? null;
            $largura = null; $altura = null; $comprimento = null; $peso = null;

            if ($catId) {
                $cat = DB::table('categorias')->where('id', $catId)->first();
                if ($cat) {
                    $largura = isset($cat->avg_largura) && $cat->avg_largura > 0 ? floatval($cat->avg_largura) : null;
                    $altura = isset($cat->avg_altura) && $cat->avg_altura > 0 ? floatval($cat->avg_altura) : null;
                    $comprimento = isset($cat->avg_comprimento) && $cat->avg_comprimento > 0 ? floatval($cat->avg_comprimento) : null;
                    $peso = isset($cat->avg_peso) && $cat->avg_peso > 0 ? floatval($cat->avg_peso) : null;
                }
            }

            // se algum valor estiver null usa defaults (se existir)
            if (!$largura || !$altura || !$comprimento || !$peso) {
                if ($catId && isset($categoryDefaults[$catId])) {
                    $d = $categoryDefaults[$catId];
                } else {
                    // fallback genérico (camisa)
                    $d = $categoryDefaults[1];
                }
                $largura = $largura ?: $d['largura'];
                $altura = $altura ?: $d['altura'];
                $comprimento = $comprimento ?: $d['comprimento'];
                $peso = $peso ?: $d['peso'];
            }

            // volume por unidade (cm3)
            $volumeUnit = $largura * $altura * $comprimento;
            $totalVolume += $volumeUnit * $quant;

            // peso real total
            $totalPesoReal += $peso * $quant;
        }

        // Peso cúbico (divisor 6000)
        $pesoCubico = ($totalVolume / 6000.0); // em kg

        // peso cobrado
        $pesoFinal = max($totalPesoReal, $pesoCubico);

        // Zona por CEP (3 primeiros dígitos)
        $prefixoCep = intval(substr($cep, 0, 3));

        if ($prefixoCep <= 199) {
            $multiplicador = 1.0;
            $zonaLabel = 'local';
        } elseif ($prefixoCep <= 399) {
            $multiplicador = 1.2;
            $zonaLabel = 'estadual';
        } elseif ($prefixoCep <= 699) {
            $multiplicador = 1.5;
            $zonaLabel = 'regional';
        } else {
            $multiplicador = 2.0;
            $zonaLabel = 'nacional';
        }

        // Base de preço
        $precoBaseKg = 6.50; // R$/kg
        $taxaFixa = 5.00;

        $valorFrete = ($pesoFinal * $precoBaseKg * $multiplicador) + $taxaFixa;
        $valorFinal = (int) ceil($valorFrete);

        return [
            'valor' => (float) $valorFinal,
            'peso_cobrado' => round($pesoFinal, 2),
            'peso_real' => round($totalPesoReal, 2),
            'peso_cubico' => round($pesoCubico, 3),
            'zona' => $zonaLabel,
            'multiplicador' => $multiplicador,
            'volume_cm3' => round($totalVolume, 2)
        ];
    }
}
