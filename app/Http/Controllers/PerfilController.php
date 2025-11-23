<?php

namespace App\Http\Controllers;

use App\model\{Pedido, Endereco, Carrinho};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FazerPedidoController;
use RealRashid\SweetAlert\Facades\Alert;

class PerfilController extends Controller
{


    public static function pedidosApi()
    {
        $pedidos = Pedido::where('user_id', Auth::id())->with('carrinho', 'carrinho.itens', 'carrinho.itens.produto')->paginate(7);
        $orders = $pedidos->map(function ($pedido) {
            return [
                'id' => $pedido->id,
                'date' => $pedido->created_at->format('Y-m-d'),
                'customer' => $pedido->user->name ?? 'Cliente',
                'status' => $pedido->status,
                'total' => $pedido->preco_total,
                'items' => $pedido->carrinho->itens->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->produto->nome,
                        'qty' => $item->quantidade,
                        'size' => $item->tamanho,
                        'price' => $item->produto->valor,
                        'img' => $item->produto->fotos->first()->url_imagem,
                    ];
                }),
            ];
        });;
        return response()->json([
            // 🔥 AQUI entra o JSON no formato que você quer usar no JS!
            'orders' => $pedidos,
        ]);
    }
    public function index($id = null, $activeTab = null)
    {

        $enderecosMostrar = Endereco::where('user_id', Auth::id())->where('status', 'ativo')->get();
        $isAjax = request()->ajax();

        if ($isAjax) {
            $pedidos = Pedido::where('user_id', Auth::id())->with('carrinho', 'carrinho.itens', 'carrinho.itens.produto')->paginate(7);
            $orders = $pedidos->map(function ($pedido) {
                return [
                    'id' => $pedido->id,
                    'date' => $pedido->created_at->format('Y-m-d'),
                    'customer' => $pedido->user->name ?? 'Cliente',
                    'status' => $pedido->status,
                    'total' => $pedido->preco_total,
                    'items' => $pedido->carrinho->itens->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->produto->nome,
                            'qty' => $item->quantidade,
                            'size' => $item->tamanho,
                            'price' => $item->produto->valor,
                            'img' => $item->produto->fotos->first()->url_imagem,
                        ];
                    }),
                ];
            });;
            return response()->json([
                // 🔥 AQUI entra o JSON no formato que você quer usar no JS!
                'orders' => $pedidos,
            ]);
        }
        $pedidos = Pedido::where('user_id', Auth::id())->with('carrinho', 'carrinho.itens', 'carrinho.itens.produto')->paginate(7);

        if (isset($id)) {
            $enderecosEditar = Endereco::where('id', $id)->where('user_id', Auth::id())->first();
            if (!$enderecosEditar) {
                $enderecosEditar = null;
            }
            $activeTab = 3;
            return view('site.perfil', ['enderecoEditar' => $enderecosEditar, 'enderecosMostrar' => $enderecosMostrar, 'pedidos' => $pedidos, 'activeTab' => $activeTab]);
        } else if ($activeTab == 3) {
            return view('site.perfil', ['enderecosMostrar' => $enderecosMostrar, 'pedidos' => $pedidos, 'activeTab' => $activeTab]);
        } else {
            $activeTab = null;
            return view('site.perfil', ['enderecosMostrar' => $enderecosMostrar, 'pedidos' => $pedidos, 'activeTab' => $activeTab]);
        }
    }

    public function exibirEndereco()
    {
        $activeTab = 3;
        return $this->index($id = null, $activeTab);
    }

    public function cancelarPedido($id)
    {
        $pedido = Pedido::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$pedido) {
            return back();
        } else if ($pedido->status == 'pago' || $pedido->status == 'enviado' || $pedido->status == 'entregue') {
            Alert::error('Erro', 'Este pedido não pode ser cancelado, pois já foi pago ou enviado. Entre em contato na aba Contato para solicitar o cancelamento.');
            return back();
        }
        $pedido->status = 'cancelado';
        $pedido->save();

        Alert::success('Pedido', 'Pedido cancelado com sucesso');
        return back();
    }

    public function confirmarPedido($id)
    {
        $pedido = Pedido::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$pedido) {
            Alert::error('Erro', 'Pedido inválido');
            return back();
        }
        $pedido->status = 'entregue';
        $pedido->save();

        Alert::success('Pedido', 'Pedido confirmado com sucesso');
        return back();
    }

    protected function tabControl($activeTab)
    {
        switch ($activeTab) {
            case 1:
                return 'tab-pane fade show active';
                break;
            case 2:
                return 'tab-pane fade';
                break;
            case 3:
                return 'tab-pane fade';
                break;
            case 4:
                return 'tab-pane fade';
                break;
            case 5:
                return 'tab-pane fade';
                break;
            case 6:
                break;
            //return 'tab-pane fade';
            case 7:
                break;
            default:
                return 'tab-pane fade';
                break;
        }
    }
}
