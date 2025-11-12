<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\{Pedido, Produto, User, Categoria, Notificacao};
use RealRashid\SweetAlert\Facades\Alert;

class PrincipalController extends Controller
{

    private $notificacaoContador;
    private $notificacao;

    public function __construct()
    {
        $this->notificacaoContador = notificacao::NotificacaoContador();
        $this->notificacao = notificacao::notificacaoPedido();
    }

    public function index()
    {
        // Dados para os cards
        $totalVendas = Pedido::where('status', 'entregue')->count();
        $totalProdutos = Produto::count();
        $totalUsuarios = User::count();
        $pedidosPendentes = Pedido::where('status', 'aguardando')->count();

        // Dados para o gráfico de vendas mensais
        $vendasMensais = $this->getVendasMensais();

        // Dados para o gráfico de categorias
        $categoriasProdutos = $this->getProdutosPorCategoria();

        // Atividades recentes
        $atividadesRecentes = $this->getAtividadesRecentes();

        $notificacaoContador = $this->notificacaoContador;
        $notificacao = $this->notificacao;
                Alert::toast('Bem vindo(a) ao painel de produtos', 'success')->width('400px')->timerProgressBar();
        return view('administrativo.principal', compact(
            'totalVendas',
            'totalProdutos',
            'totalUsuarios',
            'pedidosPendentes',
            'vendasMensais',
            'categoriasProdutos',
            'atividadesRecentes',
            'notificacaoContador',
            'notificacao'
        ));
    }

    private function getVendasMensais()
    {
        $meses = [];
        $valores = [];
        //
        for ($i = 5; $i >= 0; $i--) {
            $data = Carbon::now()->subMonths($i);
            $meses[] = $data->format('M');

            $valores[] = Pedido::where('status', 'entregue')
                ->whereMonth('created_at', $data->month)
                ->whereYear('created_at', $data->year)
                ->count();
        }

        return [
            'labels' => $meses,
            'data' => $valores
        ];
    }

    private function getProdutosPorCategoria()
    {
        $categorias = Categoria::withCount('produtos')->get();

        $labels = [];
        $data = [];
        $colors = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'];

        foreach ($categorias as $index => $categoria) {
            $labels[] = $categoria->nome;
            $data[] = $categoria->produtos_count;
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'colors' => array_slice($colors, 0, count($labels))
        ];
    }

    private function getAtividadesRecentes()
    {
        $atividades = [];

        // Últimos pedidos
        $pedidos = Pedido::with('user')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        foreach ($pedidos as $pedido) {
            $atividades[] = [
                'icon' => 'fas fa-shopping-cart bg-primary',
                'time' => $pedido->created_at->format('H:i'),
                'title' => 'Nova venda realizada',
                'content' => 'Pedido #' . $pedido->id . ' - Cliente: ' . $pedido->user->name,
                'created_at' => $pedido->created_at
            ];
        }

        // Últimos produtos cadastrados
        $produtos = Produto::with('categoria')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        foreach ($produtos as $produto) {
            $atividades[] = [
                'icon' => 'fas fa-box bg-success',
                'time' => $produto->created_at->format('H:i'),
                'title' => 'Novo produto cadastrado',
                'content' => 'Produto: ' . $produto->nome . ' - Categoria: ' . $produto->categoria->nome,
                'created_at' => $produto->created_at
            ];
        }

        // Últimos usuários cadastrados
        $usuarios = User::orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        foreach ($usuarios as $usuario) {
            $atividades[] = [
                'icon' => 'fas fa-user bg-warning',
                'time' => $usuario->created_at->format('H:i'),
                'title' => 'Novo usuário registrado',
                'content' => 'Usuário: ' . $usuario->name,
                'created_at' => $usuario->created_at
            ];
        }

        // Ordenar todas as atividades por data
        usort($atividades, function ($a, $b) {
            return $b['created_at'] <=> $a['created_at'];
        });

        return array_slice($atividades, 0, 5);
    }
}
