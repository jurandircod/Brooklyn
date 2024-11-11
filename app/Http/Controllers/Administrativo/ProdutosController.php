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
use Illuminate\Validation\Rules\Unique;

class ProdutosController extends Controller
{

    private $produtos;
    private $categorias;
    private $marca;

    public function __construct()
    {
        $this->marca = Marca::all();
        $this->produtos = Produtos::all();
        $this->categorias = Categoria::all();
    }
    public function index()
    {
        $produtos = $this->produtos;
        $produtosCategorias = $this->categorias;
        $produtosMarca = $this->marca;
        return view('administrativo.produto', compact('produtos', 'produtosCategorias', 'produtosMarca'));
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
        //$cores = $request->input('cores');
        // $teste = $this->salvarCor($cores);

        $nomeProduto = $data['nome'];
        //transforma o tamanho em string


        $data['tamanho'] = implode(',', $data['tamanho']);

        $caminho = public_path() . '/uploads/produtos/' . $nomeProduto;
        $pasta =  $this->criarPasta($caminho);

        $caminhoFoto = public_path() . '/uploads/produtos/' . $nomeProduto . '/';
        $foto = $this->criarImagem($caminhoFoto);


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
                $data['nome'] = str_replace('.', '-', $data['nome']);
                $fotos['url_imagem'] = $caminhoFoto;
                $produto = Produtos::create($data);
                $fotos['produto_id'] = $produto->id;
                try {
                    Fotos::create($fotos);
                } catch (\Exception $e) {
                    Alert::alert('Erro', $e->getMessage(), 'error');
                    return redirect()->route('administrativo.produtos');
                }
                return redirect()->route('administrativo.produtos');
            } catch (\Exception $e) {
                Alert::alert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.produtos');
            }
        }
    }

    public function salvarCor($cores)
    {

        $cores = json_decode($cores, true);
        try {
            if (is_array($cores)) { // Verifica se $cores é realmente um array
                foreach ($cores as $cor) {
                    $novaCor = new Cores();
                    $novaCor->cor = $cor;
                    $novaCor->save();
                }
                return true;
            } else {
                throw new \Exception("Erro: '$cores' não é um array válido.");
            }
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return $e->getMessage();
        }
    }

    public function alterarCor(Request $request, $id) {}

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

    public function criarImagem($caminhoFoto)
    {

        foreach ($_FILES['url_imagem']['tmp_name'] as $index => $tmpName) {
            // Verifica se o arquivo foi enviado sem erros
            if ($_FILES['url_imagem']['error'][$index] === UPLOAD_ERR_OK) {
                // Nome original do arquivo
                $nomeOriginal = $_FILES['url_imagem']['name'][$index];

                // Caminho completo para salvar a imagem
                $caminhoCompleto = $caminhoFoto . basename($nomeOriginal);

                // Move o arquivo temporário para o caminho de destino
                if (move_uploaded_file($tmpName, $caminhoCompleto)) {
                    return $caminhoCompleto;
                } else {
                    $this->redirecionaError("Erro ao enviar o arquivo.");
                }
            } else {
                $this->redirecionaError("Erro ao enviar o arquivo.");
            }
        }
    }

    public function redirecionaError($error)
    {
        Alert::alert('Erro', $error, 'error');
        return redirect()->route('administrativo.produtos');
    }
}
