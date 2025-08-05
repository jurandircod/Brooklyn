<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\{Pedido, Endereco};
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{


    public function index()
    {
        $enderecosMostrar = Endereco::where('user_id', Auth::id())->get();
        $pedidos = Pedido::where('user_id', Auth::id())->paginate(7);

        if (request()->ajax()) {
            return response()->json([
                'table' => view('site.layouts._pages.perfil.partials.pedidos-table', compact('pedidos'))->render(),
                'pagination' => view('site.layouts._pages.perfil.partials.pedidos-pagination', compact('pedidos'))->render()
            ]);
        }

        return view('site.perfil', compact('enderecosMostrar', 'pedidos'));
    }

    public function exibirEndereco()
    {

        $activeTab = 3;

        $pedidos = Pedido::where('user_id', Auth::user()->id)->get();
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        } else {
            $enderecos = Endereco::where('user_id', Auth::user()->id)->get();
            return view('site.perfil', compact('enderecos', 'activeTab', 'pedidos', 'pedidosContador'));
        }
    }
}
