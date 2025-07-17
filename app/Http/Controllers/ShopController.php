<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Categoria;
use App\Marca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    private $produtos;
    private $categorias;
    private $marcas;

    public function __construct()
    {
        $this->produtos = Produtos::all();
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
    }
    public function index(Request $request)
    {
        $produtos = $this->produtos;
        $categorias = $this->categorias;
        $marcas = $this->marcas;
        return view('site.shop', compact('produtos', 'categorias', 'marcas'));
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
        $query = Produtos::query()->with(['categoria', 'marca', 'fotos']);

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
                ->where(function ($query) use ($sizes, $sizeColumns) {
                    foreach ($sizes as $size) {
                        if (isset($sizeColumns[$size])) {
                            $query->orWhere(function ($q) use ($sizeColumns, $size) {
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

        // Executar a query
        $products = $query->get();

        // Logar os produtos com detalhes das fotos
        Log::info('Query executada:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);
        Log::info('Produtos encontrados:', [
            'count' => $products->count(),
            'data' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'nome' => $product->nome,
                    'imagem_url' => $product->imagem_url,
                    'fotos' => $product->fotos->toArray(),
                ];
            })->toArray()
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $products,
        ], 200);
    }
}
