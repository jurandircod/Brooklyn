<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ItemCarrinho;
use App\Produto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VendasController extends Controller
{
    public function index(Request $request)
    {
        $periodo = $request->get('periodo', 'all');
        
        // Query base para buscar produtos mais vendidos
        $query = ItemCarrinho::select([
                'produto_id',
                DB::raw('SUM(quantidade) as total_vendido'),
                DB::raw('SUM(preco_total) as total_faturado')
            ])
            ->whereHas('carrinho', function ($q) {
                $q->where('status', '!=', 'ativo'); // Apenas carrinhos finalizados
            })
            ->with(['produto' => function ($q) {
                $q->select('id', 'nome');
            }])
            ->groupBy('produto_id');

        // Aplicar filtro de período
        switch ($periodo) {
            case 'month':
                $query->whereHas('carrinho', function ($q) {
                    $q->where('created_at', '>=', Carbon::now()->subMonth());
                });
                break;
                
            case 'year':
                $query->whereHas('carrinho', function ($q) {
                    $q->where('created_at', '>=', Carbon::now()->subYear());
                });
                break;
                
            default: // 'all'
                // Sem filtro adicional
                break;
        }

        // Ordenar por quantidade vendida (decrescente) e paginar
        $produtos = $query->orderBy('total_vendido', 'desc')
                         ->paginate(10);

        return view('administrativo.vendas', compact('produtos', 'periodo'));
    }

    /**
     * Método alternativo caso você queira usar dados da tabela de pedidos
     * (descomente se preferir esta abordagem)
     */
    /*
    public function indexAlternativo(Request $request)
    {
        $periodo = $request->get('periodo', 'all');
        
        $query = DB::table('item_carrinhos as ic')
            ->join('carrinhos as c', 'ic.carrinho_id', '=', 'c.id')
            ->join('pedidos as p', 'c.user_id', '=', 'p.user_id') // Assumindo relação por user
            ->join('produtos as pr', 'ic.produto_id', '=', 'pr.id')
            ->select([
                'ic.produto_id',
                'pr.nome as produto_nome',
                DB::raw('SUM(ic.quantidade) as total_vendido'),
                DB::raw('SUM(ic.preco_total) as total_faturado')
            ])
            ->where('p.status_pagamento', 'aprovado'); // Apenas pedidos pagos

        // Aplicar filtro de período
        switch ($periodo) {
            case 'month':
                $query->where('p.created_at', '>=', Carbon::now()->subMonth());
                break;
                
            case 'year':
                $query->where('p.created_at', '>=', Carbon::now()->subYear());
                break;
        }

        $produtos = $query->groupBy('ic.produto_id', 'pr.nome')
                         ->orderBy('total_vendido', 'desc')
                         ->paginate(10);

        return view('admin.produtos.mais-vendidos', compact('produtos', 'periodo'));
    }
    */
}