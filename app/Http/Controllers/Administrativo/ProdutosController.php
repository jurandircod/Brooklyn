<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Produtos;
use App\Categoria;
use App\Marca;
use App\Fotos;
use App\Estoque;
use App\Http\Controllers\ExistenciaController;
use App\ItemCarrinho;
use Psr\EventDispatcher\StoppableEventInterface;

class ProdutosController extends Controller
{

    private $produtos;
    private $categorias;
    private $marca;
    private $estoques;


    public function __construct()
    {
        $this->marca = Marca::all();
        $this->produtos = Produtos::all();
        $this->categorias = Categoria::all();
        $this->estoques = Estoque::all();
    }
    public function index()
    {
        $produtos = Produtos::all();
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $estoques = Estoque::all();

        return view('administrativo.produto', compact(
            'produtos',
            'categorias',
            'marcas',
            'estoques'
        ));
    }

    public function validarInput($request)
    {

        $validator = Validator::make($request, [
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'marca_id' => 'required|integer|exists:marcas,id',
            'valor' => 'required|max:255|min:1',
            'url_imagem[]' => 'image|max:2048',
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

        return $validator;
    }

    public function salvarProduto(Request $request)
    {

        $data = $request->all();
        $nomeProduto = $data['nome'] . uniqid();


        $estoque = $this->criaObjctEstoque($data);
        $this->criarCaminhoFoto($nomeProduto);

        if (empty($data['marca_id']) || !is_numeric($data['marca_id'])) {
            $data['marca_id'] = null;
        }

        $validator = $this->validarInput($data);
        if ($validator->fails()) {
            Alert::alert('Produto', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('administrativo.produtos')
                ->withErrors($validator)
                ->withInput();
        } else {
            try {
                $data = $this->formatDataParaProduto($data);
                $produto = Produtos::create($data);
                Alert::alert('Produto', 'Salva com sucesso', 'success');
                $estoque['produto_id'] = $produto->id;
                $estoque->quantidade = $data['quantidade'];
                $estoque->save();
                $caminhoFoto = '/uploads/produtos/' . $nomeProduto . '/';
                $this->criarFotos($caminhoFoto, $produto);
                return redirect()->route('administrativo.produtos');
            } catch (\Exception $e) {
                Alert::alert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.produtos');
            }
        }
    }

    public function criarCaminhoFoto($nomeProduto)
    {
        $caminho = public_path() . '/uploads/produtos/' . $nomeProduto;
        $this->criarPasta($caminho);

        $caminhoFoto = public_path() . '/uploads/produtos/' . $nomeProduto . '/';
        $this->criarImagem($caminhoFoto);
    }

    public function criarPasta($caminho)
    {

        if (!file_exists($caminho)) { // Verifica se a pasta já existe para evitar erros
            if (mkdir($caminho, 0777, true)) {
                return true;
            } else {
                return true;
            }
        }
    }

    public function formatDataParaProduto($data)
    {

        $data['valor'] = str_replace(['R$', ' '], '', $data['valor']);
        $data['valor'] = str_replace(',', '.', $data['valor']);
        unset($data['url_imagem']);
        unset($data['quantidadeP']);
        unset($data['quantidadeM']);
        unset($data['quantidadeG']);
        unset($data['quantidadeGG']);
        $data['nome'] = str_replace('.', '-', $data['nome']);
        return $data;
    }

    public function criarFotos($caminhoFoto, $produto)
    {
        Fotos::create([
            'url_imagem' => $caminhoFoto,
            'produto_id' => $produto->id
        ]);
    }

    public function criaObjctEstoque($data)
    {
        $estoque = new Estoque;
        $estoque->quantidadeP = $data['quantidadeP'] ?? 0;
        $estoque->quantidadeM = $data['quantidadeM'] ?? 0;
        $estoque->quantidadeG = $data['quantidadeG'] ?? 0;
        $estoque->quantidadeGG = $data['quantidadeGG'] ?? 0;
        $estoque->quantidade775 = $data['quantidade775'] ?? 0;
        $estoque->quantidade8 = $data['quantidade8'] ?? 0;
        $estoque->quantidade825 = $data['quantidade825'] ?? 0;
        $estoque->quantidade85 = $data['quantidade85'] ?? 0;
        return $estoque;
    }

    public function criarImagem($caminhoFoto)
    {
        $caminhosFotos = []; // Array para armazenar os caminhos das fotos

        foreach ($_FILES['url_imagem']['tmp_name'] as $index => $tmpName) {
            // Verifica se o arquivo foi enviado sem erros
            if ($_FILES['url_imagem']['error'][$index] === UPLOAD_ERR_OK) {
                // Nome original do arquivo
                $nomeOriginal = $_FILES['url_imagem']['name'][$index];

                // Caminho completo para salvar a imagem
                $caminhoCompleto = $caminhoFoto . basename($nomeOriginal);

                // Move o arquivo temporário para o caminho de destino
                if (move_uploaded_file($tmpName, $caminhoCompleto)) {
                    $caminhosFotos[] = $caminhoCompleto; // Armazena o caminho no array
                } else {
                    $this->redirecionaError("Erro ao enviar o arquivo.");
                }
            } else {
                $this->redirecionaError("Erro ao enviar o arquivo.");
            }
        }

        return $caminhosFotos; // Retorna o array com todos os caminhos das fotos
    }

    public function deleteProduto(Request $request)
    {

        try {
            $id = $request->input('id');
            $produto = Produtos::find($id);
            // exemplo: 'imagens/'

            $produto->delete();
            return redirect()->back();
            echo "Todas as imagens foram excluídas.";
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'danger');
            return redirect()->back();
        }
    }

    public function redirecionaError($mensagem)
    {
        Alert::alert('Erro', $mensagem, 'danger');
        return redirect()->back();
    }

    public function excluir(Request $request)
    {
        $id = $request->input('produto_id');
        $this->produtos = Produtos::all();
        ExistenciaController::produtoExiste($id);
        try {
            $id = $request->input('produto_id');
            // Validação básica
            if (empty($id)) {
                throw new \Exception("ID do produto não informado");
            }

            // Encontra e exclui o produto
            $produto = Produtos::findOrFail($id);
            $item = itemCarrinho::where('produto_id', $id)->first();
            if (!$item) {
                $estoque = Estoque::where('produto_id', $id)->first();

                // verifica se é uma pasta
                $diretorio = $produto->pasta;
                if ($this->excluiPasta($diretorio)) {
                    $estoque->delete();
                    $produto->delete();
                    $produtos = $this->produtos;
                    Alert::alert('Exclusão', 'Imagens excluídas com sucesso', 'success');
                    return redirect()->route('administrativo.produtos', ['produtos' => $produtos]);
                    exit();
                } else {
                    throw new \Exception("Erro ao excluir a pasta de imagens do produto.");
                }
            } else {
                Alert::alert('Exclusão', 'Erro ao excluir produto, já está em um carrinho, DESATIVE O PRODUTO', 'error');
                $produtos = $this->produtos;
                return redirect()->route('administrativo.produtos', ['produtos' => $produtos]);
                exit();
            }
        } catch (\Exception $e) {
            $produtos = $this->produtos; // Ou sua lógica específica para obter os produtos
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.produtos', ['produtos' => $produtos]);
        }
    }

    public function atualizar(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $produto = Produtos::find($id);

        if (empty($id)) {
            Alert::alert('Erro', 'ID do produto não informado', 'error');
            return redirect()->route('administrativo.produtos');
        }

        try {
            // Verifica se já existe estoque
            $estoque = Estoque::where('produto_id', $id)->first();

            if (!$estoque && ($data['categoria_id'] == 1 || $data['categoria_id'] == 2)) {
                // Criando novo estoque de camisas ou skates
                $estoque = $this->criaObjctEstoque($data);
                $estoque->produto_id = $id;
                $estoque->quantidade = 0;
                $estoque->save();
            } else if (($data['categoria_id'] == 1 || $data['categoria_id'] == 2)) {
                // Atualizando estoque existente de camisas ou skates
                $estoque->fill($this->criaObjctEstoque($data)->toArray());
                $estoque->quantidade = 0;
                $estoque->save();
            } else {
                // Atualizando estoque existente de outros produtos
                $estoque->fill($this->criaObjctEstoque($data)->toArray());
                $estoque->quantidade = 0;
                $estoque->quantidade = $data['quantidadeProduto'];
                $estoque->save();
            }

            $produto->update($data);

            Alert::alert('Alteração', 'Alteração realizada com sucesso', 'success');
            return redirect()->route('administrativo.produtos');
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.produtos');
        }
    }

    private function excluiPasta($urlDiretorio)
    {
        // verifica se é uma pasta
        if (is_dir($urlDiretorio)) {

            // Lista todos os arquivos de imagem no diretório (jpg, jpeg, png, gif, webp, etc.)
            $formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'com'];
            $imagens = [];

            // Lista todos os arquivos de imagem no diretório (jpg, jpeg, png, gif, webp, etc.)
            foreach (scandir($urlDiretorio) as $arquivo) {
                $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
                if (in_array($extensao, $formatosPermitidos)) {
                    $imagens[] = $urlDiretorio . $arquivo;
                }
            }

            // Verifica se a pasta está vazia e exclui o diretório
            foreach ($imagens as $imagem) {
                if (is_file($imagem)) {
                    unlink($imagem);
                    if ($this->pastaEstaVazia($urlDiretorio)) {
                        if (rmdir($urlDiretorio)) {
                            return true;
                        } else {
                            throw new \Exception("Erro ao excluir imagens, diretório não vazio");
                            exit();
                        }
                    } else {
                        throw new \Exception("Erro ao excluir imagens, pasta contem arquivos");
                        exit();
                    }
                    // Exclui o arquivo
                } else {
                    throw new \Exception("Erro ao excluir imagens");
                    exit();
                }
            }
        }
    }

    private function pastaEstaVazia($caminho)
    {
        $arquivos = scandir($caminho);
        // Remove "." e ".." que sempre aparecem
        return count(array_diff($arquivos, ['.', '..'])) === 0;
    }
}
