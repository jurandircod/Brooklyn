<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\{Pedido, Endereco};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\FazerPedidoController;

class PerfilController extends Controller
{

    public function index($activeTab = null, Request $request)
    {
        dd($request);
        $enderecosMostrar = Endereco::where('user_id', Auth::id())->get();
        $pedidos = Pedido::where('user_id', Auth::id())->paginate(7);
        if ($activeTab == null) {
            $isAjax = request()->ajax();
            if ($isAjax) {
                return FazerPedidoController::pedidosApi($pedidos);
            }
            return view('site.perfil', compact('enderecosMostrar', 'pedidos'));
        } else if ($activeTab == 3) {
            return view('site.perfil', ['enderecosMostrar' => $enderecosMostrar, 'pedidos' => $pedidos, 'activeTab' => $activeTab]);
        }
    }

    public function exibirEndereco()
    {
        $activeTab = 3;
        return $this->index($activeTab );
    }
}
