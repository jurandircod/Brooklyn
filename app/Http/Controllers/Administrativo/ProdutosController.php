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
        $produtos = $this->produtos;
        $produtosCategorias = $this->categorias;
        $produtosMarca = $this->marca;
        $listarCategoria = new Categoria;
        $listarEstoque = new Estoque;
        $listarMarca = new Marca;
        return view('administrativo.produto', compact('produtos', 'produtosCategorias', 'produtosMarca', 'listarEstoque', 'listarCategoria', 'listarMarca'));
    }

    public function validarInput($request)
    {

        $validator = Validator::make($request, [
            'nome' => 'required',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'marca_id' => 'required|integer|exists:marcas,id',
            'quantidade' => 'required|integer',
            
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'categoria_id.required' => 'O campo categoria é obrigatório',
            'categoria_id.integer' => 'O campo categoria deve ser um número inteiro',
            'categoria_id.exists' => 'O campo categoria não existe',
            'marca_id.required' => 'O campo marca é obrigatório',
            'marca_id.integer' => 'O campo marca deve ser um número inteiro',
            'marca_id.exists' => 'O campo marca não existe',
            'quantidade.required' => 'O campo quantidade é obrigatório',
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
        if ($data['quantidade'] == null) {

            $estoque->quantidadeP = $data['quantidadeP'] ?? 0;
            $estoque->quantidadeM = $data['quantidadeM'] ?? 0;
            $estoque->quantidadeG = $data['quantidadeG'] ?? 0;
            $estoque->quantidadeGG = $data['quantidadeGG'] ?? 0;
            $estoque->quantidade = $estoque->quantidadeP + $estoque->quantidadeM + $estoque->quantidadeG + $estoque->quantidadeGG;
            return $estoque;
        } else {
            $estoque->quantidadeP = $data['quantidadeP'] ?? 0;
            $estoque->quantidadeM = $data['quantidadeM'] ?? 0;
            $estoque->quantidadeG = $data['quantidadeG'] ?? 0;
            $estoque->quantidadeGG = $data['quantidadeGG'] ?? 0;
            $estoque->quantidade = $data['quantidade'] ?? 0;
            return $estoque;
        }
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
            $produto->delete();
            return redirect()->back();
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
        try {
            $id = $request->input('produto_id');
            // Validação básica
            if (empty($id)) {
                throw new \Exception("ID do produto não informado");
            }

            // Encontra e exclui o produto
            $produto = Produtos::findOrFail($id);
            $estoque = Estoque::where('produto_id', $id)->first();
            $estoque->delete();
            $produto->delete();

            // Recarrega a lista de produtos após exclusão
            $produtos = Produtos::all(); // Ou sua lógica específica para obter os produtos

            Alert::alert('Exclusão', 'Produto excluído com sucesso', 'success');
            return redirect()->route('administrativo.produtos', ['produtos' => $produtos]);
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.produtos');
        }
    }

    public function atualizar(Request $request)
    {
        $data = $request->all();

           try {
        $id = $data['id'];


        if (empty($id)) {
            throw new \Exception("ID do produto não informado");
        }
        $produto = Produtos::find($id);
        $estoque = Estoque::where('produto_id', $id)->first();

        if (empty($estoque)) {
            $estoque = new Estoque();
            $estoque->produto_id = $id;
            $estoque->quantidadeP = $data['quantidadeP'] ?? 0;
            $estoque->quantidadeM = $data['quantidadeM'] ?? 0;
            $estoque->quantidadeG = $data['quantidadeG'] ?? 0;
            $estoque->quantidadeGG = $data['quantidadeGG'] ?? 0;
            $estoque->quantidade = $estoque->quantidadeP + $estoque->quantidadeM + $estoque->quantidadeG + $estoque->quantidadeGG;
            $estoque->save();
        } else {
            $estoque->quantidadeP = $data['quantidadeP'] ?? 0;
            $estoque->quantidadeM = $data['quantidadeM'] ?? 0;
            $estoque->quantidadeG = $data['quantidadeG'] ?? 0;
            $estoque->quantidadeGG = $data['quantidadeGG'] ?? 0;
            $estoque->quantidade = $estoque->quantidadeP + $estoque->quantidadeM + $estoque->quantidadeG + $estoque->quantidadeGG;
            $estoque->update($data);
        }
        unset($data['quantidade'], $data['quantidadeP'], $data['quantidadeM'], $data['quantidadeG'], $data['quantidadeGG']);
        $produto->update($data);
        Alert::alert('Alteração', 'Alteração realizada com sucesso', 'success');
        return redirect()->route('administrativo.produtos');
           } catch (\Exception $e) {

                Alert::alert('Erro', $e->getMessage(), 'error');
               return redirect()->route('administrativo.produtos');
           }
    }
}
