<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Produto, Categoria, Marca, MapaTamanho};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    private $categorias;
    private $marcas;
    private $mapaTamanho;

    public function __construct()
    {
        $this->mapaTamanho = new MapaTamanho;
    }
    public function index(Request $request, $id = null)
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();

        $categorias = $this->categorias;
        $marcas = $this->marcas;

        // Construir query base
        $query = $this->buildQuery($request);

        // Se for requisição AJAX (filtro ou paginação)
        if ($request->ajax()) {
            // Para filtros com paginação, pegar a página da URL se existir
            $page = $request->input('page', $request->query('page', 1));
            $produtos = $query->paginate(8, ['*'], 'page', $page);
            $sizes = $request->input('sizes', []);


            // Se for uma requisição de filtro (POST)
            if ($request->isMethod('POST')) {
                return response()->json([
                    'status' => 'success',
                    'data' => $produtos->items(),
                    'pagination_html' => view('site.layouts._pages.pesquisaProduto.partials.produtos-pagination', compact('produtos'))->render(),
                    'pagination_info' => [
                        'current_page' => $produtos->currentPage(),
                        'last_page' => $produtos->lastPage(),
                        'total' => $produtos->total(),
                        'per_page' => $produtos->perPage(),
                        'has_pages' => $produtos->hasPages()
                    ],
                    'teste' => $sizes,
                ], 200);
            }

            // Se for paginação (GET)
            return response()->json([
                'table' => view('site.layouts._pages.pesquisaProduto.partials.produtos-table', compact('produtos'))->render(),
                'pagination' => view('site.layouts._pages.pesquisaProduto.partials.produtos-pagination', compact('produtos'))->render()
            ], 200);
        }

        // Requisição normal (não AJAX)
        if (!$id) {
            $produtos = $query->where('estado', 'ativo')->paginate(8);
            return view('site.shop', compact('produtos', 'categorias', 'marcas'));
        } else {
            $produtos = $query->where('produtos.categoria_id', $id)->where('estado', 'ativo')->paginate(8);
            return view('site.shop', compact('produtos', 'categorias', 'marcas'));
        }
    }

    private function buildQuery(Request $request)
    {
        //
        $query = Produto::query()->with(['categoria', 'marca', 'fotos']);

        // Se não há filtros, retorna query básica
        if (!$request->hasAny(['sizes', 'categorias', 'marcas', 'min_price', 'max_price'])) {
            return $query;
        }

        // Validação
        $validator = Validator::make($request->all(), [
            'sizes' => 'nullable|array',
            'categorias' => 'nullable|array',
            'categorias.*' => 'integer|exists:categorias,id',
            'marcas' => 'nullable|array',
            'marcas.*' => 'integer|exists:marcas,id',

        ]);

        if ($validator->fails()) {
            Log::error('Erros de validação:', $validator->errors()->toArray());
            return $query; // Retorna query sem filtros em caso de erro
        }

        // Aplicar filtros
        $this->applyFilters($query, $request);

        return $query;
    }

    private function applyFilters($query, Request $request)
    {
        // Converter e filtrar dados
        $categorias = array_filter(array_map('intval', $request->input('categorias', [])));
        $marcas = array_filter(array_map('intval', $request->input('marcas', [])));
        $sizes = array_filter($request->input('sizes', []));

        // Filtro por categorias
        if (!empty($categorias)) {
            $query->whereIn('produtos.categoria_id', $categorias);
        }

        // Filtro por marcas
        if (!empty($marcas)) {
            $query->whereIn('produtos.marca_id', $marcas);
        }

        $query->where('produtos.estado', 'ativo');
        // Filtro por faixa de preço
        if ($request->filled('min_price')) {
            $query->where('produtos.valor', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('produtos.valor', '<=', $request->input('max_price'));
        }

        // Filtro por tamanhos
        // Filtro por tamanhos - Alternativa
        if (!empty($sizes)) {
            $query->where(function ($subQuery) use ($sizes) {
                foreach ($sizes as $size) {
                    $subQuery->orWhereHas('estoque', function ($q) use ($size) {
                        $q->where('tamanho', $size)
                            ->where('quantidade', '>', 0)
                            ->where('ativo', 'S');
                    });
                }
            });
        }
    }
}
