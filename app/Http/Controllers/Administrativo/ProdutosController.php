<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\{Produto, Categoria, Marca, Fotos, Estoque, ItemCarrinho};
use App\Http\Controllers\ExistenciaController;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProdutosController
 * 
 * Controlador responsável pela gestão de produtos no sistema administrativo.
 * Este controlador permite a criação, atualização, exclusão e listagem de produtos,
 * além de gerenciar suas imagens e estoques.
 */
class ProdutosController extends Controller
{
    protected $produtos;    // Lista de produtos
    protected $categorias;   // Lista de categorias
    protected $marcas;       // Lista de marcas
    protected $estoques;     // Lista de estoques

    /**
     * ProdutosController constructor.
     * Inicializa as listas de marcas, produtos, categorias e estoques.
     */
    public function __construct()
    {
        $this->marcas = Marca::all();
        $this->categorias = Categoria::all();
        $this->estoques = Estoque::all();
    }

    /**
     * Exibe a lista de produtos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('administrativo.produto', [
            'produtos' => $this->myProducts(),
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
            'estoques' => $this->estoques
        ]);
    }

    /**
     * Obtém os produtos do usuário autenticado.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function myProducts()
    {
        $itens = Produto::where('user_id', auth()->id())->get();
        return $itens;
    }

    /**
     * Valida os dados de entrada do produto.
     *
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validarInput($request)
    {
        return Validator::make($request, [
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'marca_id' => 'required|integer|exists:marcas,id',
            'valor' => 'required|min:0.01',
            'url_imagem' => 'required|array|min:1'
        ], [
            'valor.integer' => 'O campo valor deve ser um número inteiro',
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
    public function salvarProduto(Request $request)
    {
        $data = $request->all();

        $validator = $this->validarInput($data);

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
            return $this->redirectWithError($e->getMessage());
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
        $data['user_id'] = auth()->id();
        $produto = Produto::create($data);
        if ($data['categoria_id'] == 1) {
            $estoque = $this->createStockObjectCamisa($data);
        } else if ($data['categoria_id'] == 2) {
            $estoque = $this->createStockObjectSkate($data);
        } else {
            $estoque = $this->createStockObject($data);
        }
        $estoque->produto_id = $produto->id;
        $estoque->save();

        return $produto;
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
    protected function createStockObjectCamisa(array $data): Estoque
    {
        $dataEstoque = new Estoque([
            'quantidadeP' => $data['quantidadeP'] ?? 0,
            'quantidadeM' => $data['quantidadeM'] ?? 0,
            'quantidadeG' => $data['quantidadeG'] ?? 0,
            'quantidadeGG' => $data['quantidadeGG'] ?? 0,
        ]);
        return $dataEstoque;
    }

    /**
     * Cria um objeto skate de estoque a partir dos dados do produto.
     *
     * @param array $data
     * @return Estoque
     */
    public function createStockObjectSkate(array $data): Estoque
    {
        $dataEstoque = new Estoque([
            'quantidade775' => $data['quantidade775'] ?? $data['quanti775'] ?? 0,
            'quantidade8' => $data['quantidade8'] ?? 0,
            'quantidade825' => $data['quantidade825'] ?? 0,
            'quantidade85' => $data['quantidade85'] ?? 0,
        ]);
        return $dataEstoque;
    }

    public function createStockObject(array $data): Estoque
    {
        $dataEstoque = new Estoque([
            'quantidade' => $data['quantidade'] ?? 0,
        ]);
        return $dataEstoque;
    }

    /**
     * Faz o upload das imagens para o diretório especificado.
     *
     * @param string $destinationPath
     * @return array
     */
    protected function uploadImages(string $destinationPath): array
    {
        $uploadedPaths = [];

        foreach ($_FILES['url_imagem']['tmp_name'] ?? [] as $index => $tmpName) {
            if ($_FILES['url_imagem']['error'][$index] !== UPLOAD_ERR_OK) {
                continue;
            }

            $fileName = basename($_FILES['url_imagem']['name'][$index]);
            $fullPath = $destinationPath . $fileName;

            if (move_uploaded_file($tmpName, $fullPath)) {
                $uploadedPaths[] = $fullPath;
            } else {
                $this->redirectWithError("Erro ao enviar o arquivo.");
            }
        }

        return $uploadedPaths;
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
    public function excluir(Request $request)
    {
        try {
            $id = $request->input('produto_id');
            $this->validateProductId($id);

            $produto = Produto::findOrFail($id);

            if (ItemCarrinho::where('produto_id', $id)->exists()) {
                return $this->redirectWithError(
                    'Erro ao excluir produto, já está em um carrinho, DESATIVE O PRODUTO',
                    'Exclusão',
                    'error'
                );
            }

            $this->deleteProductWithDependencies($produto);

            Alert::success('Exclusão', 'Imagens excluídas com sucesso');
            return redirect()->route('administrativo.produtos', ['produtos' => $this->produtos]);
        } catch (Exception $e) {
            return $this->redirectWithError($e->getMessage());
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

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'com'];
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
    public function atualizar(Request $request)
    {
        try {
            $data = $request->all();
            dd($request);
            $validator = $this->validarImagem($data);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            DB::transaction(function () use ($data) {
                $this->validateProductId($data['id'] ?? null);
                $produto = Produto::findOrFail($data['id']);
                $this->updateProductStock($produto, $data);
                $produto->update($data);
            });
            Alert::success('Alteração', 'Alteração realizada com sucesso');
            return redirect()->route('administrativo.produtos');
        } catch (Exception $e) {
            return $this->redirectWithError($e->getMessage());
        }
    }

    public function atualizarImagem(Request $request)
    {
        $produto = Produto::findOrFail($request->id);

        $imagem = $produto->imagem_url;
        $imagem2 = $produto->imagem_url2;
        $imagem3 = $produto->imagem_url3;
        $imagem4 = $produto->imagem_url4;
        $imagem5 = $produto->imagem_url5;

        if ($request->hasFile('imagem_1')) {
            if (Storage::exists($imagem)) {
                Storage::delete($imagem);
            }
        } else if ($request->hasFile('imagem_2')) {
            if (Storage::exists($imagem2)) {
                Storage::delete($imagem2);
            }
        } else if ($request->hasFile('imagem_3')) {
            if (Storage::exists($imagem3)) {
                Storage::delete($imagem3);
            }
        } else if ($request->hasFile('imagem_4')) {
            if (Storage::exists($imagem4)) {
                Storage::delete($imagem4);
            }
        } else if ($request->hasFile('imagem_5')) {
            if (Storage::exists($imagem5)) {
                Storage::delete($imagem5);
            }
        }

        // Salvar a imagem_3 (se existir)
        if ($request->hasFile('imagem_3')) {
            $pathImagem3 = $request->file('imagem_3')->store('public/imagens');
        }
    }


    public function validarImagem($data)
    {
        return Validator::make(
            $data,
            [
                'imagem_2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagem_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagem_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imagem_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'imagem_2.required' => 'Por favor, selecione a imagem do produto',
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
        $estoque = Estoque::firstOrNew(['produto_id' => $produto->id]);
        $estoque->fill($this->createStockObject($data)->toArray());
        if (in_array($data['categoria_id'], [1, 2])) {
            $estoque->quantidade = 0; // Observer calculará automaticamente
        } else {
            $estoque->quantidade = $data['quantidadeProduto'] ?? 0;
        }
        $estoque->save();
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
