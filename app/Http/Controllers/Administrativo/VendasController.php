<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Produto, ItemCarrinho, Pedido, Notificacao};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VendasController extends Controller
{

    private $notificacaoContador;
    private $notificacao;

    public function __construct()
    {
        $this->notificacaoContador = notificacao::NotificacaoContador();
        $this->notificacao = notificacao::notificacaoPedido();
    }

    public function index(Request $request)
    {

        $query = Pedido::query()->with('user', 'endereco');
        if (!empty($request->get('periodo'))) {
            switch ($request->get('periodo')) {
                case 'month':
                    $query->where('created_at', '>=', Carbon::now()->subMonth());
                    break;
                case 'year':
                    $query->where('created_at', '>=', Carbon::now()->subYear());
                    break;
            }
        }

        if (!empty($request->get('status'))) {
            switch ($request->get('status')) {
                case 'pago':
                    $query->where('status', 'pago');
                    break;
                case 'enviado':
                    $query->where('status', 'enviado');
                    break;
                case 'entregue':
                    $query->where('status', 'entregue');
                    break;
                case 'cancelado':
                    $query->where('status', 'cancelado');
                    break;
                case 'aguardando':
                    $query->where('status', 'aguardando');
                    break;
            }
        }
        $pedidos = $query->paginate(6);

        $pedidoStatus = $request->get('statusPedido');
        $idPedido = $request->get('idPedido');

        if (!empty($pedidoStatus) and !empty($idPedido)) {
            $pedido = Pedido::find($idPedido);
            $pedido->status = $pedidoStatus;
            $pedido->save();
        }

        $page = $request->get('page');

        $totais = [
            'total_vendas' => Pedido::count(),
            'total_faturado' => Pedido::sum('preco_total'),
            'ticket_medio' => Pedido::avg('preco_total'),
        ];
        $periodo = $request->get('periodo', 'all');

        $status = ['aguardando' => 'Aguardando', 'pago' => 'Pago', 'enviado' => 'Enviado', 'entregue' => 'Entregue', 'cancelado' => 'Cancelado'];

        $notificacaoContador = $this->notificacaoContador;
        $notificacao = $this->notificacao;
        return view('administrativo.vendas', compact('pedidos', 'totais', 'periodo', 'status', 'page', 'notificacao', 'notificacaoContador'));
    }

}
