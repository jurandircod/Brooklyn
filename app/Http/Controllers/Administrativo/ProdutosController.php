<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Produtos;
use App\Categoria;
use App\Marca;
use App\Cores;
use App\Fotos;
use App\corHasProdutos;
use App\Estoque;
use Illuminate\Validation\Rules\Unique;

class ProdutosController extends Controller
{

    private $produtos;
    private $categorias;
    private $marca;
    private $estoque;

    public function __construct()
    {
        $this->marca = Marca::all();
        $this->produtos = Produtos::all();
        $this->categorias = Categoria::all();
        $this->estoque = Estoque::all();
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

        ], [
            'nome.required' => 'O campo nome é obrigatório',
        ]);

        return $validator;
    }

    public function salvarProduto(Request $request)
    {
        $data = $request->all();
        $nomeProduto = $data['nome'] . uniqid();


        $estoque = $this->criaObjctEstoque($data);

        $caminho = public_path() . '/uploads/produtos/' . $nomeProduto;
        $this->criarPasta($caminho);

        $caminhoFoto = public_path() . '/uploads/produtos/' . $nomeProduto . '/';
        $caminhosFotos = $this->criarImagem($caminhoFoto);

        
        $validator = $this->validarInput($data);
        Alert::alert('Produto', 'Salva com sucesso', 'success');

        if ($validator->fails()) {
            Alert::alert('Produto', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('administrativo.produto')
                ->withErrors($validator)
                ->withInput();
        } else {
            try {
                $data['valor'] = str_replace(['R$', ' '], '', $data['valor']);
                $data['valor'] = str_replace(',', '.', $data['valor']);
                Alert::alert('Produto', 'Salva com sucesso', 'success');
                unset($data['url_imagem']);
                unset($data['quantidadeP']);
                unset($data['quantidadeM']);
                unset($data['quantidadeG']);
                unset($data['quantidadeGG']);
                $data['nome'] = str_replace('.', '-', $data['nome']);

                $produto = Produtos::create($data);
                $estoque['produto_id'] = $produto->id;

                $estoque->save();
                $caminhoFoto = '/uploads/produtos/' . $nomeProduto . '/';
                Fotos::create([
                    'url_imagem' => $caminhoFoto,
                    'produto_id' => $produto->id
                ]);


                return redirect()->route('administrativo.produtos');
            } catch (\Exception $e) {
                Alert::alert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.produtos');
            }
        }
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

    public function redirecionaError($mensagem)
    {
        Alert::alert('Erro', $mensagem, 'danger');
        return redirect()->back();
    }
}
