<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\{Pedido, Endereco};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\FazerPedidoController;

class PerfilController extends Controller
{

    public function index($id = null, $activeTab = null)
    {
        $enderecosMostrar = Endereco::where('user_id', Auth::id())->get();
        $pedidos = Pedido::where('user_id', Auth::id())->paginate(7);
        $isAjax = request()->ajax();
        if ($isAjax) {
            return FazerPedidoController::pedidosApi($pedidos);
        }

        if (isset($id)) {
            $enderecosEditar = AddressController::enviaParaformEnderecos($id);
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
            case 7
            
            :
                break;
            default:
                return 'tab-pane fade';
                break;
        }
    }
}
