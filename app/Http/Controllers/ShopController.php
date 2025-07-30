<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;
use App\Marca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    private $produtos;
    private $categorias;
    private $marcas;

    public function index(Request $request)
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        
        $query = Produto::query()->with(['categoria', 'marca', 'fotos']);
        $categorias = $this->categorias;
        $marcas = $this->marcas;

        if ($request->has('filtrar')) {
            $produtos = $this->filtrar($request);
            // Retorna os produtos filtrados com paginação
            $produtosPaginados = $query->whereIn('id', $produtos->pluck('id'))->paginate(100);
            
            return response()->json([
                'status' => 'success',
                'data' => $produtosPaginados->items(), // Apenas os itens da paginação
                'pagination' => [
                    'current_page' => $produtosPaginados->currentPage(),
                    'last_page' => $produtosPaginados->lastPage(),
                    'per_page' => $produtosPaginados->perPage(),
                    'total' => $produtosPaginados->total(),
                ]
            ], 200);
        } else {
            $produtos = $query->paginate(8);
            return view('site.shop', compact('produtos', 'categorias', 'marcas'));
        }
    }

    public function filtrar(Request $request)
    {
        // Log dos dados recebidos
        Log::info('Dados recebidos no filtro:', $request->all());

        // Validação
        $validator = Validator::make($request->all(), [
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|in:P,M,G,GG,7.75,8,8.25,8.5',
            'categorias' => 'nullable|array',
            'categorias.*' => 'integer|exists:categorias,id',
            'marcas' => 'nullable|array',
            'marcas.*' => 'integer|exists:marcas,id',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0|gte:min_price',
        ]);

        if ($validator->fails()) {
            Log::error('Erros de validação:', $validator->errors()->toArray());
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Converter strings para inteiros e filtrar valores falsy
        $categorias = array_filter(array_map('intval', $request->input('categorias', [])));
        $marcas = array_filter(array_map('intval', $request->input('marcas', [])));
        $sizes = array_filter($request->input('sizes', []));

        // Construir a query com eager loading
        $query = Produto::query()->with(['categoria', 'marca', 'fotos']);

        // Mapear tamanhos para colunas de estoque
        $sizeColumns = [
            'P' => 'quantidadeP',
            'M' => 'quantidadeM',
            'G' => 'quantidadeG',
            'GG' => 'quantidadeGG',
            '7.75' => 'quantidade775',
            '8' => 'quantidade8',
            '8.25' => 'quantidade825',
            '8.5' => 'quantidade85',
        ];

        // Filtro por tamanhos no estoque com leftJoin
        if (!empty($sizes)) {
            $query->leftJoin('estoques', 'produtos.id', '=', 'estoques.produto_id')
                ->where(function ($subQuery) use ($sizes, $sizeColumns) {
                    foreach ($sizes as $size) {
                        if (isset($sizeColumns[$size])) {
                            $subQuery->orWhere(function ($q) use ($sizeColumns, $size) {
                                $q->whereNotNull('estoques.id')
                                  ->where('estoques.' . $sizeColumns[$size], '>', 0);
                            });
                        }
                    }
                });
        }

        // Filtro por categorias
        if (!empty($categorias)) {
            $query->whereIn('produtos.categoria_id', $categorias);
        }

        // Filtro por marcas
        if (!empty($marcas)) {
            $query->whereIn('produtos.marca_id', $marcas);
        }

        // Filtro por faixa de preço
        if ($request->filled('min_price')) {
            $query->where('produtos.valor', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('produtos.valor', '<=', $request->input('max_price'));
        }

        // Garantir produtos distintos e selecionar apenas colunas de produtos
        $query->select('produtos.*')->distinct();

        // Executar a query e retornar os produtos
        $products = $query->get();
        
        Log::info('Produtos filtrados encontrados:', ['count' => $products->count()]);
        
        return $products;
    }
}