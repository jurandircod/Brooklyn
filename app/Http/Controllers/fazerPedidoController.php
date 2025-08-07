<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\model\{Estoque, ItemCarrinho, Pedido, Endereco};
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Services\MercadoPagoService;

class FazerPedidoController extends Controller
{

    private $tamanhoMap = [
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


    public function index()
    {
        $enderecos = Endereco::where('user_id', auth()->id())->get();
        $itens = $this->queryBuilderItensCarrinho();

        $preco_total = $itens->sum('preco_total');
        $contador = $itens->count();

        if ($contador == 0) {
            Alert::error('Erro', 'Não há itens para fazer pedido');
            return back();
        }

        return view('site.fazerPedido', compact('enderecos', 'itens', 'preco_total', 'contador'));
    }

    public function queryBuilderItensCarrinho()
    {
        return ItemCarrinho::with(['produto.fotos', 'carrinho'])
            ->whereHas('carrinho', function ($query) {
                $query->where('user_id', auth()->id())
                    ->where('status', 'ativo');
            })
            ->select('item_carrinhos.*')
            ->get()
            ->map(function ($item) {
                $item->produto_nome = $item->produto->nome;
                $item->produto_valor = $item->produto->valor;
                $item->produto_imagem = optional($item->produto->fotos->first())->url_imagem;
                $item->produto_id = $item->produto->id;
                return $item;
            });
    }

    public function finalizarCarrinho(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            Alert::error('Erro', 'Usuário não autenticado.');
            return back();
        }


        $request->merge([
            'cpf' => '11117634965',
            'descricao' => 'teste'
        ]);

        $validator = $this->validateInput($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ($request->metodo_pagamento == 'pix') {
            $payment = new PaymentController(new MercadoPagoService());
            $qrcode = $payment->createPixPayment($request);
            $data = $qrcode->getData();
            $status = $data->status;
            $qr_code = $data->qr_code;
            $qr_code_base64 = $data->qr_code_base64;
            $expiration = $data->expiration;
            $valor = $request->valor;
            return view('site.pix', compact('status', 'qr_code', 'qr_code_base64', 'expiration', 'valor'));
            exit;
        }

        return DB::transaction(function () use ($request, $user) {
            $itens = $this->queryBuilderItensCarrinho();

            if ($itens->isEmpty()) {
                Alert::error('Erro', 'Carrinho vazio');
                return back();
            }

            $carrinho = $itens->first()->carrinho;
            if (!$carrinho || $carrinho->status == 'finalizado') {
                Alert::error('Erro', 'Carrinho inválido ou já finalizado');
                return back();
            }

            // Verifica estoque antes de processar
            foreach ($itens as $item) {
                $tamanho = $item->tamanho;
                $campoTamanho = $this->tamanhoMap[$tamanho] ?? null;

                if (!$campoTamanho) {
                    throw new \Exception("Tamanho '{$tamanho}' não é válido.");
                }

                $estoque = Estoque::where('produto_id', $item->produto_id)->first();

                if (!$estoque || $estoque->$campoTamanho < $item->quantidade) {
                    throw new \Exception("Estoque insuficiente para o produto {$item->produto_nome} (tamanho {$tamanho}).");
                }
            }

            // Processa atualização de estoque
            foreach ($itens as $item) {
                $tamanho = $item->tamanho;
                $campoTamanho = $this->tamanhoMap[$tamanho];
                $estoque = Estoque::where('produto_id', $item->produto_id)->first();
                $estoque->$campoTamanho -= $item->quantidade;
                $estoque->quantidade -= $item->quantidade;
                $estoque->save();
            }

            $preco_total = $itens->sum('preco_total');

            // Finaliza carrinho
            $carrinho->status = 'finalizado';
            $carrinho->save();

            // Cria pedido
            Pedido::create([
                'user_id' => $user->id,
                'preco_total' => $preco_total,
                'metodo_pagamento' => $request->metodo_pagamento,
                'endereco_id' => $request->endereco_id,
                'status' => 'aguardando'
            ]);

            Alert::success('Pedido', 'Pedido realizado com Sucesso');
            return redirect()->route('site.principal');
        });
    }


    private function validateInput($request)
    {
        return Validator::make($request, [
            'endereco_id' => [
                'required',
                'numeric',
                'exists:enderecos,id,user_id,' . auth()->id() // Garante que o endereço pertence ao usuário
            ],
            'metodo_pagamento' => 'required|in:dinheiro,credito,debito,pix', // Adicione todos os métodos válidos
        ], [
            'metodo_pagamento.required' => 'Selecione um método de pagamento',
            'metodo_pagamento.in' => 'Método de pagamento inválido',
            'endereco_id.required' => 'Selecione pelo menos um endereço',
            'endereco_id.numeric' => 'O campo endereço deve ser numérico',
            'endereco_id.exists' => 'O endereço selecionado não existe ou não pertence a você',
        ]);
    }
}
