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
            'sizes.*' => 'string',
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

        // Converter strings para inteiros
        $categorias = array_filter(array_map('intval', $request->input('categorias', [])));
        $marcas = array_filter(array_map('intval', $request->input('marcas', [])));
        $sizes = array_filter($request->input('sizes', []));

        // Construir a query com eager loading
        $query = Produtos::query()->with(['categoria', 'marca', 'fotos', 'estoque']);

        switch ($sizes) {
            case 'P':
                $query->where('quantidadeP', 'quantidadeP');
                break;
            case 'M':
                $query->where('quantidadeM', 'quantidadeM');
                break;
            case 'G':
                $query->where('quantidadeG', 'quantidadeG');
                break;
            case 'GG':
                $query->where('quantidadeGG', 'quantidadeGG');
                break;
            case '7.75':
                $query->where('quantidade775', 'quantidade775');
                break;
            case '8':
                $query->where('quantidade8', 'quantidade8');
                break;
            case '8.25':
                $query->where('quantidade825', 'quantidade825');
                break;
            case '8.5':
                $query->where('quantidade85', 'quantidade85');
                break;
            default:
                $query->where('quantidade', 'quantidade');
                break;
        }
        // Filtro por categorias
        if (!empty($categorias)) {
            $query->whereIn('categoria_id', $categorias);
        }

        // Filtro por marcas
        if (!empty($marcas)) {
            $query->whereIn('marca_id', $marcas);
        }

        // Filtro por faixa de preço
        if ($request->filled('min_price')) {
            $query->where('valor', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('valor', '<=', $request->input('max_price'));
        }

        // Executar a query
        $products = $query->get();

        // Logar a query e os resultados
        Log::info('Query executada:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);
        Log::info('Produtos encontrados:', ['count' => $products->count(), 'data' => $products->toArray()]);

        return response()->json([
            'status' => 'success',
            'data' => $products,
        ], 200);
    }
}
