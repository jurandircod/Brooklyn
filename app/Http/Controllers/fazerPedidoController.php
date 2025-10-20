<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\model\{Carrinho, Estoque, ItemCarrinho, Pedido, Endereco, MapaTamanho};
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Services\MercadoPagoService;
use Faker\Provider\ar_EG\Payment;

class FazerPedidoController extends Controller
{

    public function index()
    {
        $enderecos = Endereco::where('user_id', auth()->id())->where('status', 'ativo')->get();
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

    function normalizarValor($valor)
    {
        // troca vírgula por ponto e remove espaços
        $valor = str_replace(',', '.', trim($valor));

        // converte pra float
        $valor = (float) $valor;

        // formata com duas casas decimais e ponto como separador
        return number_format($valor, 2, '.', '');
    }
    public function finalizarCarrinho(Request $request)
    {
        $validator = $this->validateInput($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = auth()->user();

        $valor = $this->normalizarValor($request->input('valor'));
        // Exemplo rápido: montando payload de pagamento (substitua pela lógica real)
        $amount = $valor; // ou calcule $preco_total
        $description = 'Pagamento Brooklyn - pedido do usuário ' . ($user->id ?? 'anon');

        // Cria o service via container (respeita DI)
        $mpService = app(\App\Services\MercadoPagoService::class);
        $customer = [
            'email' => $user->email,
            'first_name' => $user->name,
            'last_name' => $user->name,
            // CPF real se tiver — atenção em produção
            'cpf' => '11117634965' // CPF do usuário
        ];

        $pixData = $mpService->createPixPayment($amount, $description, $customer);

        return view('site.pix', compact('pixData'));

        exit;
        return DB::transaction(function () use ($request, $user) {
            $carrinho = Carrinho::where('user_id', $user->id)->where('status', 'ativo')->first();
            if (!$carrinho) {
                Alert::error('Erro', 'Carrinho inválido');
                return back();
            }

            $itens = ItemCarrinho::where('carrinho_id', $carrinho->id)->get();
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
                $estoque = Estoque::where('produto_id', $item->produto_id)->where('tamanho', $tamanho)->first();
                $teste[] = $estoque->quantidade;
                if (!$estoque || $estoque->quantidade < $item->quantidade) {
                    throw new \Exception("Estoque insuficiente para o produto {$item->produto_nome} (tamanho {$tamanho}).");
                }
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

    public static function pedidosApi($pedidosPassados)
    {
        $pedidos = $pedidosPassados;
        return response()->json([
            'table' => view('site.layouts._pages.perfil.partials.pedidos-table', compact('pedidos'))->render(),
            'pagination' => view('site.layouts._pages.perfil.partials.pedidos-pagination', compact('pedidos'))->render()
        ]);
    }
}
