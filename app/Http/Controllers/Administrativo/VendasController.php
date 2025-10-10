<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\{Produto, ItemCarrinho, Pedido};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VendasController extends Controller
{
    public function index(Request $request)
    {
        $periodo = $request->get('periodo', 'all');
        $status = $request->get('status');
        // 🔹 Consulta principal: produtos mais vendidos
        $query = ItemCarrinho::select([
            'produto_id',
            DB::raw('SUM(quantidade) as total_vendido'),
            DB::raw('SUM(preco_total) as total_faturado')
        ])
            ->whereHas('carrinho', function ($q) {
                $q->where('status', 'finalizado');
            })
            ->with(['produto:id,nome,valor'])
            ->groupBy('produto_id');

        // 🔹 Filtro de período (opcional)
        if ($periodo === 'month') {
            $query->whereHas('carrinho', fn($q) => $q->where('created_at', '>=', Carbon::now()->subMonth()));
        } elseif ($periodo === 'year') {
            $query->whereHas('carrinho', fn($q) => $q->where('created_at', '>=', Carbon::now()->subYear()));
        }
        if (!empty($status) && $status != 'all') {
            $query->whereHas('carrinho.user.pedido', fn($q) => $q->where('status', $status));
        }

        $produtos = $query->orderByDesc('total_vendido')->paginate(10);

        // 🔹 Para cada produto, buscar último pedido vinculado (com endereço)
        foreach ($produtos as $produto) {
            $ultimaVenda = Pedido::with(['user:id,name', 'endereco'])
                ->whereHas('user.carrinhos.itens', fn($q) => $q->where('produto_id', $produto->produto_id))
                ->orderByDesc('id')
                ->first();

            if ($ultimaVenda) {
                $produto->comprador = $ultimaVenda->user->name ?? '—';
                $produto->status_venda = ucfirst($ultimaVenda->status);
                $produto->endereco_entrega = $ultimaVenda->endereco
                    ? "{$ultimaVenda->endereco->logradouro}, {$ultimaVenda->endereco->numero} - {$ultimaVenda->endereco->bairro}, {$ultimaVenda->endereco->cidade}/{$ultimaVenda->endereco->estado} ({$ultimaVenda->endereco->cep})"
                    : 'Endereço não informado';
            } else {
                $produto->comprador = '—';
                $produto->status_venda = '—';
                $produto->endereco_entrega = '—';
            }
        }
        $status = ['aguardando' => 'Aguardando', 'pago' => 'Pago', 'enviado' => 'Enviado', 'entregue' => 'Entregue', 'cancelado' => 'Cancelado'];
        // 🔹 Totais gerais
        $totais = [
            'total_vendas' => Pedido::count(),
            'total_faturado' => Pedido::sum('preco_total'),
            'ticket_medio' => Pedido::avg('preco_total'),
        ];

        return view('administrativo.vendas', compact('produtos', 'totais', 'periodo', 'status'));
    }
}
