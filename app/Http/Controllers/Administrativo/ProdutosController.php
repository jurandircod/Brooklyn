<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\model\{Produto, Categoria, Marca, Fotos, Estoque, ItemCarrinho, Notificacao};
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\model\Tamanho;


/**
 * Class ProdutosController
 * 
 * Controlador responsável pela gestão de produtos no sistema administrativo.
 * Este controlador permite a criação, atualização, exclusão e listagem de produtos,
 * além de gerenciar suas imagens e estoques.
 */
class ProdutosController extends Controller
{

    private $notificacaoContador;
    private $notificacao;
    protected $produtos;    // Lista de produtos
    protected $categorias;   // Lista de categorias
    protected $marcas;       // Lista de marcas
    protected $estoques;     // Lista de estoques

    private $mapaTamanho = [
        'p' => 'p',
        'm' => 'm',
        'g' => 'g',
        'gg' => 'gg',
        'G' => 'G',
        'M' => 'M',
        'P' => 'P',
        'GG' => 'GG',
        775 => '775',
        8 => '8',
        825 => '825',
        85 => '85',
        '38' => '38',
        '39' => '39',
        '40' => '40',
        '41' => '41',
        '42' => '42',
        38 => '38',
        39 => '39',
        40 => '40',
        41 => '41',
        42 => '42',
    ];

    private $calcasCamisas = [
        'p' => 'p',
        'm' => 'm',
        'g' => 'g',
        'gg' => 'gg',
        'G' => 'G',
        'M' => 'M',
        'P' => 'P',
        'GG' => 'GG',
    ];

    private $skates = [
        775 => '775',
        8 => '8',
        825 => '825',
        85 => '85',
    ];

    private $tenis = [
        '38' => '38',
        '39' => '39',
        '40' => '40',
        '41' => '41',
        '42' => '42',
        38 => '38',
        39 => '39',
        40 => '40',
        41 => '41',
        42 => '42',
    ];
    private $tamanhos;

    /**
     * ProdutosController constructor.
     * Inicializa as listas de marcas, produtos, categorias e estoques.
     */
    public function __construct()
    {
        $this->marcas = Marca::all();
        $this->categorias = Categoria::all();
        $this->notificacaoContador = notificacao::NotificacaoContador();
        $this->notificacao = notificacao::notificacaoPedido();
    }

    /**
     * Exibe a lista de produtos com paginação.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Configurações de paginação
        $perPage = $request->get('per_page', 10); // Itens por página (padrão: 10)
        $search = $request->get('search', ''); // Termo de busca
        $categoria = $request->get('categoria_id', ''); // Filtro por categoria
        $marca = $request->get('marca_id', ''); // Filtro por marca
        $orderBy = $request->get('order_by', 'nome'); // Ordenação (padrão: nome)
        $orderDirection = $request->get('order_direction', 'asc'); // Direção da ordenação

        // Buscar produtos paginados
        $produtos = $this->myProductsPaginated($perPage, $search, $categoria, $marca, $orderBy, $orderDirection);

        // Se for uma requisição AJAX (para DataTables), retornar JSON
        $estoques = [];
        foreach ($produtos as $produto) {
            if ($produto->estoque->count() > 0) {
                $estoques[] = $produto->estoque;
            } else {
                $estoques[] = 0;
            }
        }


        $notificacaoContador = $this->notificacaoContador;
        $notificacao = $this->notificacao;
        // Retornar view normal
        if (isset($_GET['alterado'])) {
            Alert::alert('Produto', 'Alterado com sucesso', 'success');
        }
        return view('administrativo.produto', [
            'produtos' => $produtos,
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
            'estoques' => $estoques,
            'currentSearch' => $search,
            'currentCategoria' => $categoria,
            'currentMarca' => $marca,
            'perPage' => $perPage,
            'tamanhos' => $this->tamanhos,
            'notificacaoContador' => $notificacaoContador,
            'notificacao' => $notificacao
        ]);
    }

    /**
     * Obtém os produtos do usuário autenticado com paginação e filtros.
     *
     * @param int $perPage
     * @param string $search
     * @param string $categoria
     * @param string $marca
     * @param string $orderBy
     * @param string $orderDirection
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function myProductsPaginated($perPage = 10, $search = '', $categoria = '', $marca = '', $orderBy = 'nome', $orderDirection = 'asc')
    {
        $query = Produto::where('user_id', auth()->id())->where('estado', 'ativo')
            ->with(['categoria', 'marca', 'estoque']); // Eager loading para performance

        // Aplicar filtros de busca
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'LIKE', "%{$search}%")->where('estado', 'ativo')
                    ->orWhere('material', 'LIKE', "%{$search}%")
                    ->orWhere('descricao', 'LIKE', "%{$search}%")
                    ->orWhereHas('categoria', function ($subQ) use ($search) {
                        $subQ->where('nome', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('marca', function ($subQ) use ($search) {
                        $subQ->where('nome', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Filtrar por categoria
        if (!empty($categoria)) {
            $query->where('categoria_id', $categoria);
        }

        // Filtrar por marca
        if (!empty($marca)) {
            $query->where('marca_id', $marca);
        }

        // Aplicar ordenação
        $allowedOrderColumns = ['nome', 'valor', 'material', 'created_at', 'updated_at'];
        if (in_array($orderBy, $allowedOrderColumns)) {
            $query->orderBy($orderBy, $orderDirection === 'desc' ? 'desc' : 'asc');
        }

        // Retornar dados paginados
        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Método original mantido para compatibilidade
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function myProducts()
    {
        return Produto::where('user_id', auth()->id())->where('estado', 'ativo')->get();
    }

    /**
     * API endpoint para buscar produtos (usado pelo DataTables)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterProducts(Request $request)
    {
        $produtos = Produto::with(['categoria', 'marca', 'estoque'])
            ->select('produtos.*');

        if (!$request->has('order') || empty($request->input('order')[0]['dir'])) {
            $produtos->orderBy('id', 'desc');
        }

        if ($request->has('search')) {
            $produtos->where(function ($query) use ($request) {
                $query->where('nome', 'LIKE', "%{$request->search}%")
                    ->orWhere('material', 'LIKE', "%{$request->search}%")
                    ->orWhere('descricao', 'LIKE', "%{$request->search}%");
            });
        }

        if ($request->has('filtroCategoria') and $request->filtroCategoria != 0) {
            $produtos->where('categoria_id', $request->filtroCategoria);
        }

        if ($request->has('filtroMarca') and $request->filtroMarca != 0) {
            $produtos->where('marca_id', $request->filtroMarca);
        }

        $datatable = datatables()->eloquent($produtos);

        // gera thumbs on the fly
        for ($i = 1; $i <= 5; $i++) {
            $attr = $i == 1 ? 'imagem_url' : 'imagem_url' . $i;
            $datatable->addColumn($attr, function ($produto) use ($attr) {
                return $produto->$attr ? asset($produto->$attr) : null;
                //mantém o original também
            });
        }
        $datatable
            ->addColumn('categoria', fn($produto) => $produto->categoria->nome ?? '')
            ->addColumn('marca', fn($produto) => $produto->marca->nome ?? '')
            ->addColumn('status', fn($produto) => $produto->estado == 'ativo' ? 'Ativo' : 'Inativo')
            ->addColumn('quantidade_total', fn($produto) => $produto->estoque->sum('quantidade'))
            ->with([
                'draw' => intval($request->input('draw', 0))
            ]);
        return $datatable->toJson();
    }




    /**
     * Método para exportar produtos (Excel, PDF, etc.)
     *
     * @param Request $request
     * @return mixed
     */
    public function export(Request $request)
    {
        $formato = $request->get('formato', 'excel'); // excel, pdf, csv
        $produtos = $this->myProducts(); // Todos os produtos para exportação

        switch ($formato) {
            case 'excel':
                return $this->exportarExcel($produtos);
            case 'pdf':
                return $this->exportarPDF($produtos);
            case 'csv':
                return $this->exportarCSV($produtos);
            default:
                return redirect()->back()->with('error', 'Formato não suportado');
        }
    }

    /**
     * Busca rápida de produtos (para autocomplete)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchProducts(Request $request)
    {
        $term = $request->get('q', '');
        $limit = $request->get('limit', 10);

        $produtos = Produto::where('user_id', auth()->id())
            ->where(function ($query) use ($term) {
                $query->where('nome', 'LIKE', "%{$term}%")
                    ->orWhere('material', 'LIKE', "%{$term}%");
            })
            ->select('id', 'nome', 'valor', 'imagem_url')
            ->limit($limit)
            ->get();

        return response()->json($produtos);
    }

    // Métodos privados para exportação (implementar conforme necessário)
    private function exportarExcel($produtos)
    {
        // Implementar exportação Excel
        // return Excel::download(new ProdutosExport($produtos), 'produtos.xlsx');
    }

    private function exportarPDF($produtos)
    {
        // Implementar exportação PDF
        // return PDF::loadView('administrativo.produtos.pdf', compact('produtos'))->download('produtos.pdf');
    }

    private function exportarCSV($produtos)
    {
        // Implementar exportação CSV
    }

    // Todos os outros métodos do controller permanecem iguais
    // (validarInput, salvarProduto, prepareProductData, etc...)

    /**
     * Valida os dados de entrada do produto.
     *
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateInput($request)
    {
        return Validator::make($request, [
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'marca_id' => 'required|integer|exists:marcas,id',
            'valor' => 'required|min:0.01',
            'valor_compra' => 'required|min:0.01',
            'url_imagem' => 'required|array|min:1', // Garante que pelo menos 1 arquivo foi enviado
            'url_imagem.*' => 'file|mimes:jpeg,png,jpg,gif|max:20480' // Valida cada arquivo
        ], [
            'valor.integer' => 'O campo valor deve ser um número inteiro',
            'valor_compra.required' => 'O campo valor de compra deve ser preenchido',
            'valor_compra.min' => 'O campo valor de compra deve ser maior que 0',
            'url_imagem.required' => 'O campo imagem é obrigatório',
            'url_imagem.array' => 'O campo imagem deve ser mais de um arquivo',
            'url_imagem.*.mimes' => 'O campo imagem deve ser um arquivo de imagem',
            'url_imagem.*.max' => 'O campo imagem deve ter no máximo 2048 caracteres',
            'valor.255' => 'O campo valor deve ser menor que 255',
            'valor.min' => 'O campo valor deve ser maior que 1',
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser uma string',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'categoria_id.required' => 'O campo categoria é obrigatório',
            'categoria_id.integer' => 'O campo categoria deve ser um número inteiro',
            'categoria_id.exists' => 'O campo categoria não existe',
            'marca_id.required' => 'O campo marca é obrigatório',
            'marca_id.integer' => 'O campo marca deve ser um número inteiro',
            'marca_id.exists' => 'O campo marca não existe',
            'quantidade.integer' => 'O campo quantidade deve ser um número inteiro',
            'valor.required' => 'O campo valor é obrigatório',
        ]);
    }

    /**
     * Salva um novo produto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $validator = $this->validateInput($data);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::transaction(function () use ($data) {
                $data = $this->prepareProductData($data);
                $produto = $this->createProductWithStock($data);
                $this->handleProductImages($produto, $data['nome']);
            });
            Alert::success('Produto', 'Salvo com sucesso');
            return redirect()->route('administrativo.produtos');
        } catch (Exception $e) {
            return $this->redirectWithError($e->getMessage())->withInput();
        }
    }

    /**
     * Prepara os dados do produto para armazenamento.
     *
     * @param array $data
     * @return array
     */
    protected function prepareProductData(array $data): array
    {
        $data['valor'] = str_replace(['R$', ' ', ','], ['', '', '.'], $data['valor']);
        $data['valor_compra'] = str_replace(['R$', ' ', ','], ['', '', '.'], $data['valor_compra']);
        $data['nome'] = str_replace('.', '-', $data['nome']);
        $data['marca_id'] = empty($data['marca_id']) || !is_numeric($data['marca_id']) ? null : $data['marca_id'];
        return $data;
    }

    /**
     * Cria um produto e seu estoque associado.
     *
     * @param array $data
     * @return Produto
     */
    protected function createProductWithStock(array $data)
    {
        try {
            $data['user_id'] = auth()->id();
            // tenta criar o produto
            $produto = Produto::create($data);

            // tenta criar o estoque
            $this->createStockObject($data, $produto->id);

            return $produto;
        } catch (Exception $e) {

            // Loga o erro no storage/logs/laravel.log
            Log::error('Erro ao criar produto: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $data
            ]);

            // Exibe alerta amigável no front
            Alert::error('Erro!', 'Ocorreu um problema ao criar o produto.');

            // OU se quiser ver o erro na tela (apenas para debug):
            // dd($e->getMessage());

        }
    }

    /**
     * Manipula as imagens do produto.
     *
     * @param Produto $produto
     * @param string $productName
     */
    protected function handleProductImages(Produto $produto, string $productName)
    {
        $folderName = $produto->id;
        $imagePath = public_path("/uploads/produtos/{$folderName}/");
        if (is_dir($imagePath)) {
            File::deleteDirectory($imagePath);
        }

        $this->createFolder($imagePath);
        $this->uploadImages($imagePath);

        Fotos::create([
            'url_imagem' => "/uploads/produtos/{$folderName}/",
            'produto_id' => $produto->id
        ]);
    }

    /**
     * Cria um objeto camisa de estoque a partir dos dados do produto.
     *
     * @param array $data
     * @return Estoque
     */
    protected function createStockObject(array $data, int $produtoId)
    {

        $dadosFiltrados = array_filter($data, function ($valor, $chave) {
            // Remove campos nulos
            return $valor !== null && $valor !== '' && $valor !== '0';
        }, ARRAY_FILTER_USE_BOTH);

        $quantidadeTotal = 0;
        if (isset($data['quantidade'])) {
            $quantidadeTotal = $data['quantidade'];
            Estoque::updateOrCreate(
                [
                    'produto_id' => $produtoId,
                    'tamanho' => 'padrao',
                ],
                [
                    'quantidade' => $quantidadeTotal,
                    'ativo' => 'S'
                ]
            );
        } else {
            foreach ($dadosFiltrados as $key => $value) {
                if (!isset($this->mapaTamanho[$key])) {
                    continue;
                }

                $tamanho = null;

                switch (intval($dadosFiltrados['categoria_id'])) {
                    case 1:
                        $tamanho = strval($this->calcasCamisas[$key]) ?? 'padrao';
                        break;
                    case 2:
                        $tamanho = strval($this->skates[$key]) ?? 'padrao';
                        break;
                    case 3:
                        $tamanho = strval($this->tenis[$key]) ?? 'padrao';
                        break;
                    case 4:
                        $tamanho = strval($this->calcasCamisas[$key]) ?? 'padrao';
                        break;
                    default:
                        Alert::alert('errors', 'erro ao salvar categoria não existe no banco');
                        return back();
                };

                $quantidade = intVal($value) ?? 0;
                $quantidadeTotal += $quantidade;
                if (intVal($quantidade) > 0) {
                    Estoque::updateOrCreate(
                        [
                            'produto_id' => $produtoId,
                            'tamanho' => $tamanho
                        ],
                        [
                            'quantidade' => $quantidade,
                            'ativo' => 'S'
                        ]
                    );
                }
            }
        }

        Produto::where('id', $produtoId)->update(['quantidade' => $quantidadeTotal]);
        return true;
    }

    /**
     * Faz o upload e otimização das imagens para o diretório especificado.
     *
     * @param string $destinationPath
     * @return array
     */
    protected function uploadImages(string $destinationPath): array
    {
        $uploadedPaths = [];
        $i = 1;

        // Garante que existam arquivos
        if (!isset($_FILES['url_imagem']) || !is_array($_FILES['url_imagem']['tmp_name'])) {
            return $uploadedPaths;
        }

        // Cria pasta se necessário
        $this->createFolder($destinationPath);

        $count = count($_FILES['url_imagem']['tmp_name']);
        for ($index = 0; $index < $count; $index++) {
            if ($_FILES['url_imagem']['error'][$index] !== UPLOAD_ERR_OK) {
                continue;
            }

            $tmpName = $_FILES['url_imagem']['tmp_name'][$index];
            $originalName = basename($_FILES['url_imagem']['name'][$index]);
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            // Salva como WebP quando possível (fallback cria jpeg/png se WebP não suportado)
            $fileName = $i++ . '.webp';
            $fullPath = rtrim($destinationPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;

            $ok = $this->convertToWebp($tmpName, $fullPath, 80);
            if ($ok && file_exists($fullPath)) {
                $uploadedPaths[] = $fullPath;
            } else {
                Log::warning("Falha ao converter/Salvar imagem: {$originalName} -> {$fullPath}");
            }
        }

        return $uploadedPaths;
    }

    /**
     * Converte imagem para WebP (tenta usar Intervention; se falhar, usa fallback GD)
     *
     * @param string $originalPath
     * @param string $webpPath
     * @param int $quality
     * @return bool
     */
    protected function convertToWebp(string $originalPath, string $webpPath, int $quality = 80)
    {
        try {
            ini_set('memory_limit', '512M');
            // Usa Intervention Image (Facade)
            $image = Image::make($originalPath);
            $image->orientate(); // corrige orientação EXIF
            $image->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // garante diretório
            $dir = dirname($webpPath);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            // Tenta codificar em webp (Intervention depende de GD/Imagick com suporte webp)
            $image->encode('webp', $quality);
            $image->save($webpPath);
            $image->destroy();

            return file_exists($webpPath);
        } catch (\Exception $e) {
            Log::error('convertToWebp (Intervention) falhou: ' . $e->getMessage());
            // Fallback nativo com GD/imagick -> tenta criar WebP direto, ou salva JPEG se não suportar
            return $this->convertToWebpNative($originalPath, $webpPath, $quality);
        }
    }

    /**
     * Fallback nativo para criar WebP (usa GD se disponível). Retorna true se arquivo criado.
     *
     * @param string $originalPath
     * @param string $webpPath
     * @param int $quality
     * @return bool
     */
    protected function convertToWebpNative(string $originalPath, string $webpPath, int $quality = 80)
    {
        try {
            $info = getimagesize($originalPath);
            if ($info === false) {
                return false;
            }
            $mime = $info['mime'];

            switch ($mime) {
                case 'image/jpeg':
                    $img = imagecreatefromjpeg($originalPath);
                    break;
                case 'image/png':
                    $img = imagecreatefrompng($originalPath);
                    // preserva transparência
                    imagepalettetotruecolor($img);
                    imagealphablending($img, true);
                    imagesavealpha($img, true);
                    break;
                case 'image/gif':
                    $img = imagecreatefromgif($originalPath);
                    break;
                default:
                    return false;
            }

            // redimensiona se necessário
            $width = imagesx($img);
            $height = imagesy($img);
            $max = 1200;
            if ($width > $max || $height > $max) {
                if ($width > $height) {
                    $newW = $max;
                    $newH = intval($height * ($max / $width));
                } else {
                    $newH = $max;
                    $newW = intval($width * ($max / $height));
                }
                $tmp = imagecreatetruecolor($newW, $newH);

                // preserva transparência quando necessário
                if ($mime === 'image/png' || $mime === 'image/gif') {
                    imagealphablending($tmp, false);
                    imagesavealpha($tmp, true);
                    $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
                    imagefilledrectangle($tmp, 0, 0, $newW, $newH, $transparent);
                }

                imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newW, $newH, $width, $height);
                imagedestroy($img);
                $img = $tmp;
            }

            // garante diretório
            $dir = dirname($webpPath);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            // se function imagewebp existe, gera webp; senão gera jpeg como fallback
            if (function_exists('imagewebp')) {
                // quality 0-100
                imagewebp($img, $webpPath, $quality);
            } else {
                // fallback sem suporte a webp: salva jpeg no caminho solicitado (extensão pode ser webp mas conteúdo jpeg)
                imagejpeg($img, $webpPath, $quality);
            }

            imagedestroy($img);

            return file_exists($webpPath);
        } catch (\Throwable $e) {
            Log::error('convertToWebpNative falhou: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Otimiza e salva a imagem com configurações adequadas 
     *
     * @param string $tmpPath
     * @param string $savePath
     * @param string $extension
     */
    protected function optimizeAndSaveImage(string $tmpPath, string $savePath, string $extension)
    {
        // garante diretório
        $dir = dirname($savePath);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $image = Image::make($tmpPath);
        $image->orientate();
        $image->resize(1200, 1200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $ext = strtolower($extension);
        switch ($ext) {
            case 'jpeg':
            case 'jpg':
                $image->encode('jpg', 80);
                break;
            case 'png':
                // PNG: encode aceita quality 0-9 para driver GD via Intervention; aqui usamos 8 como compressão
                $image->encode('png', 8);
                break;
            case 'webp':
                // tenta webp, se falhar o próprio Intervention lançará e o catch pode tratar
                try {
                    $image->encode('webp', 80);
                } catch (\Exception $e) {
                    Log::warning('encode webp falhou no optimizeAndSaveImage: ' . $e->getMessage());
                    $image->encode('jpg', 80);
                }
                break;
            default:
                $image->encode($ext, 80);
        }

        $image->save($savePath);
        $image->destroy();
    }

    /**
     * Cria um diretório se ele não existir.
     *
     * @param string $path
     * @return bool
     */
    protected function createFolder(string $path): bool
    {
        if (!file_exists($path)) {
            return mkdir($path, 0777, true);
        }
        return true;
    }

    /**
     * Exclui um produto e suas dependências.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        try {
            $produto = Produto::find($id);
            if (is_null($produto)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produto não encontrado.'
                ], 404);
            }

            $produto->estado = 'inativo';
            $produto->save();
            return response()->json([
                'success' => true,
                'message' => "$produto->estado"
            ], 200);
        } catch (\Throwable $e) {
            if ($e instanceof \Exception) {
                Log::error($e->getMessage());
            } else {
                Log::error('Erro interno ao excluir produto');
            }

            return response()->json([
                'success' => false,
                'message' => 'Erro interno ao excluir produto',
                'error' => $e->getMessage() // remova essa linha quando for debug
            ], 500);
        }
    }

    /**
     * Exclui um produto e suas imagens associadas.
     *
     * @param Produto $produto
     */
    protected function deleteProductWithDependencies(Produto $produto)
    {
        $this->deleteProductImages($produto->pasta);

        Estoque::where('produto_id', $produto->id)->delete();
        $produto->delete();
    }

    /**
     * Exclui as imagens de um produto.
     *
     * @param string $directory
     */
    protected function deleteProductImages(string $directory)
    {
        if (!is_dir($directory)) {
            return;
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $images = array_filter(scandir($directory), function ($file) use ($allowedExtensions) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return in_array($extension, $allowedExtensions);
        });

        foreach ($images as $image) {
            $imagePath = $directory . $image;
            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->isDirectoryEmpty($directory)) {
            rmdir($directory);
        }
    }

    /**
     * Verifica se um diretório está vazio.
     *
     * @param string $path
     * @return bool
     */
    protected function isDirectoryEmpty(string $path): bool
    {
        return count(array_diff(scandir($path), ['.', '..'])) === 0;
    }

    /**
     * Atualiza os dados de um produto.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        try {
            $data = $request->all();

            $validator = $this->validarImagem($data);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (isset($data['deleteImage'])) {
                $verifica = $this->deleteImagem($data);
            }

            $this->atualizarImagem($request);
            DB::transaction(function () use ($data) {
                $this->validateProductId($data['id'] ?? null);
                $produto = Produto::findOrFail($data['id']);
                $this->updateProductStock($produto, $data);
                $produto->update($data);
            });
            return redirect()->route('administrativo.produtos', ['alterado' => true]);
        } catch (Exception $e) {
            return $this->redirectWithError($e->getMessage());
        }
    }

    protected function deleteImagem(array $data)
    {

        $caminhoBase = public_path('uploads/produtos/' . $data['id'] . '/');
        // pega todos os arquivos
        $glob = glob($caminhoBase . '/*.{png,jpg,jpeg,gif}', GLOB_BRACE);

        foreach ($data['deleteImage'] as $key => $value) {
            foreach ($glob as $file) {
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                if ($fileName == $key) {
                    unlink($file); // Exclui a imagem
                }
            }
        }
        return true;
    }

    public function atualizarImagem(Request $request)
    {
        $produto = Produto::findOrFail($request->id);
        $caminhoBase = public_path('uploads/produtos/' . $request->id . '/');

        // Criar diretório se não existir
        if (!file_exists($caminhoBase)) {
            mkdir($caminhoBase, 0755, true);
        }

        for ($i = 1; $i <= 5; $i++) {
            $campoImagem = 'imagem_' . $i;

            if (!$request->hasFile($campoImagem)) {
                continue;
            }

            $arquivo = $request->file($campoImagem);

            // Validação do arquivo
            $extensao = strtolower($arquivo->getClientOriginalExtension());
            if (!in_array($extensao, ['png', 'jpg', 'jpeg', 'gif', 'webp'])) {
                continue;
            }

            // Nome seguro para o arquivo
            $nomeArquivo = $i . '.' . $extensao;
            $caminhoCompleto = $caminhoBase . $nomeArquivo;

            // Remove arquivo existente com o mesmo número
            $glob = glob($caminhoBase . $i . '.{png,jpg,jpeg,gif,webp}', GLOB_BRACE);
            foreach ($glob as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            // Otimiza e salva a nova imagem
            $this->optimizeAndSaveImage($arquivo->getPathname(), $caminhoCompleto, $extensao);
        }
    }


    public function validarImagem($data)
    {
        return Validator::make(
            $data,
            [
                'imagem_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagem_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagem_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagem_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'imagem_2.nullable' => 'Por favor, selecione a imagem do produto',
                'imagem_2.image' => 'Por favor, selecione um arquivo de imagem',
                'imagem_2.mimes' => 'Por favor, selecione um arquivo de imagem',
                'imagem_2.max' => 'O arquivo selecionado é muito grande',
                'imagem_3.mimes' => 'Por favor, selecione um arquivo de imagem',
                'imagem_3.max' => 'O arquivo selecionado é muito grande',
                'imagem_4.mimes' => 'Por favor, selecione um arquivo de imagem',
                'imagem_4.max' => 'O arquivo selecionado é muito grande',
                'imagem_5.mimes' => 'Por favor, selecione um arquivo de imagem',
                'imagem_5.max' => 'O arquivo selecionado é muito grande',
            ]
        );
    }
    /**
     * Atualiza o estoque de um produto.
     *
     * @param Produto $produto
     * @param array $data
     */
    protected function updateProductStock(Produto $produto, array $data)
    {
        $this->createStockObject($data, $produto->id);
    }

    /**
     * Valida o ID do produto.
     *
     * @param mixed $id
     * @throws Exception
     */
    protected function validateProductId($id)
    {
        if (empty($id)) {
            throw new Exception("ID do produto não informado");
        }
    }

    /**
     * Redireciona com uma mensagem de erro.
     *
     * @param string $message
     * @param string $title
     * @param string $type
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectWithError(
        string $message,
        string $title = 'Erro',
        string $type = 'error'
    ) {
        Alert::alert($title, $message, $type);
        return redirect()->route('administrativo.produtos');
    }
}
