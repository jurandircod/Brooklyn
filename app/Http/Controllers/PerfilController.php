<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\{Pedido, Endereco};
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{


    public function index($activeTab = null)
    {


        $enderecosMostrar = Endereco::where('user_id', Auth::id())->get();
        $pedidos = Pedido::where('user_id', Auth::id())->paginate(7);
        if ($activeTab == null) {
            if (request()->ajax()) {
                return response()->json([
                    'table' => view('site.layouts._pages.perfil.partials.pedidos-table', compact('pedidos'))->render(),
                    'pagination' => view('site.layouts._pages.perfil.partials.pedidos-pagination', compact('pedidos'))->render()
                ]);
            }
            return view('site.perfil', compact('enderecosMostrar', 'pedidos'));
            
        }else if ($activeTab == 3) {
            return view('site.perfil',['enderecosMostrar' => $enderecosMostrar, 'pedidos' => $pedidos, 'activeTab' => $activeTab]);
        }
    }

    public function exibirEndereco()
    {
        $activeTab = 3;
        return $this->index($activeTab);
    }
}
