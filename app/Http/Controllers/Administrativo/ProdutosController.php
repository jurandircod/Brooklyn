<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\{Produto, Categoria, Marca, Fotos, Estoque, ItemCarrinho};
use App\Http\Controllers\ExistenciaController;
use Exception;

class ProdutosController extends Controller
{
    protected $produtos;
    protected $categorias;
    protected $marcas;
    protected $estoques;

    public function __construct()
    {
        $this->marcas = Marca::all();
        $this->produtos = Produto::all();
        $this->categorias = Categoria::all();
        $this->estoques = Estoque::all();
    }

    public function index()
    {
        return view('administrativo.produto', [
            'produtos' => $this->myProducts(),
            'categorias' => $this->categorias,
            'marcas' => $this->marcas,
            'estoques' => $this->estoques
        ]);
    }

    public function myProducts(){
        $itens = Produto::where('user_id', auth()->id())->get();
        return $itens;
    }

    public function validarInput($request)
    {
        return Validator::make($request, [
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'marca_id' => 'required|integer|exists:marcas,id',
            'valor' => 'required|min:0.01',
            'url_imagem.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'valor.integer' => 'O campo valor deve ser um número inteiro',
            'valor.255' => 'O campo valor deve ser menor que 255',
            'valor.min' => 'O campo valor deve ser maior que 1',
            'url_imagem[].required' => 'O campo imagem é obrigatório',
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
            $data = $this->prepareProductData($data);
            
            $produto = $this->createProductWithStock($data);

            $this->handleProductImages($produto, $data['nome']);

            Alert::success('Produto', 'Salvo com sucesso');
            return redirect()->route('administrativo.produtos');
        } catch (Exception $e) {
            
            return $this->redirectWithError($e->getMessage());
        }
    }

    protected function prepareProductData(array $data): array
    {
        $data['valor'] = str_replace(['R$', ' ', ','], ['', '', '.'], $data['valor']);
        $data['nome'] = str_replace('.', '-', $data['nome']);
        $data['marca_id'] = empty($data['marca_id']) || !is_numeric($data['marca_id']) ? null : $data['marca_id'];
        return $data;
    }

    protected function createProductWithStock(array $data)
    {
        
        $data['user_id'] = auth()->id();
        $produto = Produto::create($data);
        $estoque = $this->createStockObject($data);
        $estoque->produto_id = $produto->id;
        $estoque->save();

        return $produto;
    }

    protected function handleProductImages(Produto $produto, string $productName)
    {
        $folderName = $productName . uniqid();
        $imagePath = public_path("/uploads/produtos/{$folderName}/");

        $this->createFolder($imagePath);
        $this->uploadImages($imagePath);

        Fotos::create([
            'url_imagem' => "/uploads/produtos/{$folderName}/",
            'produto_id' => $produto->id
        ]);
    }

    protected function createStockObject(array $data): Estoque
    {
        return new Estoque([
            'quantidadeP' => $data['quantidadeP'] ?? 0,
            'quantidadeM' => $data['quantidadeM'] ?? 0,
            'quantidadeG' => $data['quantidadeG'] ?? 0,
            'quantidadeGG' => $data['quantidadeGG'] ?? 0,
            'quantidade775' => $data['quantidade775'] ?? 0,
            'quantidade8' => $data['quantidade8'] ?? 0,
            'quantidade825' => $data['quantidade825'] ?? 0,
            'quantidade85' => $data['quantidade85'] ?? 0,
        ]);
    }

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

    protected function createFolder(string $path): bool
    {
        if (!file_exists($path)) {
            return mkdir($path, 0777, true);
        }
        return true;
    }

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

    protected function deleteProductWithDependencies(Produto $produto)
    {
        $this->deleteProductImages($produto->pasta);

        Estoque::where('produto_id', $produto->id)->delete();
        $produto->delete();
    }

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

    protected function isDirectoryEmpty(string $path): bool
    {
        return count(array_diff(scandir($path), ['.', '..'])) === 0;
    }

    public function atualizar(Request $request)
    {
        try {
            $data = $request->all();
            $this->validateProductId($data['id'] ?? null);

            $produto = Produto::findOrFail($data['id']);
            $this->updateProductStock($produto, $data);
            $produto->update($data);

            Alert::success('Alteração', 'Alteração realizada com sucesso');
            return redirect()->route('administrativo.produtos');
        } catch (Exception $e) {
            return $this->redirectWithError($e->getMessage());
        }
    }

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

    protected function validateProductId($id)
    {
        if (empty($id)) {
            throw new Exception("ID do produto não informado");
        }
    }

    protected function redirectWithError(
        string $message,
        string $title = 'Erro',
        string $type = 'error'
    ) {
        Alert::alert($title, $message, $type);
        return redirect()->route('administrativo.produtos');
    }
}
