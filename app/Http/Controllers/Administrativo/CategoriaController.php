<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\model\{Produto, Categoria, Tamanho, Notificacao};

class CategoriaController extends Controller
{

    private $categorias;
    private $notificacaoContador;
    private $notificacao;

    public function __construct()
    {
        $this->categorias = Categoria::all();
        $this->notificacaoContador = notificacao::NotificacaoContador();
        $this->notificacao = notificacao::notificacaoPedido();
    }

    public function index()
    {
        $notificacaoContador = $this->notificacaoContador;
        $notificacao = $this->notificacao;
        $categorias = $this->categorias;
        return view('administrativo.categoria', compact('categorias', 'notificacaoContador', 'notificacao'));
    }

    public function salvarCategoria(Request $request)
    {

        $rotaCategoria = $request->all();
        if ($rotaCategoria['rotaCategoria'] == 1) {
            $data['nome'] = $rotaCategoria['nomeCategoria'];
            $data['descricao'] = $rotaCategoria['descricaoCategoria'];

            $validator = $this->validarInput($data);
            Alert::alert('Categoria', 'Salva com sucesso', 'success');
            if ($validator->fails()) {
                Alert::alert('Categoria', 'Preencha os campos obrigatórios', 'error');
                return redirect()
                    ->route('administrativo.produtos')
                    ->withInput()->withErrors($validator);
            } else {
                Alert::alert('Categoria', 'Salva com sucesso', 'success');
                try {
                    Categoria::create(($data));
                    return redirect()->route('administrativo.produtos')->withInput();
                } catch (\Exception $e) {
                    Alert::alert('Erro', $e->getMessage(), 'error');
                    return redirect()->route('administrativo.produtos');
                }
            }
        } else {
            $data = $request->all();
            $validator = $this->validarInput($data);
            if ($validator->fails()) {
                Alert::alert('Categoria', 'Preencha os campos obrigatórios', 'error');
                return redirect()
                    ->route('administrativo.produto.categoria')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Alert::alert('Categoria', 'Salva com sucesso', 'success');
                try {
                    Categoria::create($request->all());
                    return redirect()->route('administrativo.produto.categoria');
                } catch (\Exception $e) {
                    Alert::alert('Erro', $e->getMessage(), 'error');
                    return redirect()->route('administrativo.produto.categoria');
                }
            }
        }
    }


    public function validarInput($request)
    {

        $validator = Validator::make($request, [
            'nome' => 'required|string|unique:categorias|max:255',
            'descricao' => 'max:255',
        ], [
            'nome.required' => 'O campo categoria é obrigatório',
            'nome.string' => 'O campo categoria deve ser uma string',
            'nome.max' => 'O campo categoria deve ter no máximo 255 caracteres',
            'descricao.string' => 'O campo descricao deve ser uma string',
            'nome.unique' => 'Já existe essa categoria cadastrada',
            'descricao.max' => 'O campo descricao deve ter no máximo 255 caracteres',
        ]);

        return $validator;
    }

    public function excluirCategoria(Request $request)
    {
        try {
            Categoria::findOrFail($request->input('categoria_id'));
            $categoria = Categoria::where('id', $request->input('categoria_id'))->first();
            $categoriaPossuiProdutos = Produto::where('categoria_id', $request->input('categoria_id'))->count();
            if (($categoria->id == 1 || $categoria->id == 2) or $categoriaPossuiProdutos > 0) {
                throw new \Exception("Essa categoria não pode ser excluída, pois possui produtos cadastrados");
            } else {
                $categoria->delete();
                Alert::alert('Exclusão', 'Categoria excluída com sucesso', 'success');
                return redirect()->route('administrativo.produto.categoria');
            }
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.produto.categoria');
        }
    }

    /**
     * Altera uma categoria existente
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function alterarCategoria(Request $request)
    {
        try {
            $categoria = Categoria::findOrFail($request->input('categoria_id'));

            if ($categoria->id == 1 || $categoria->id == 2 || $categoria->id == 3 || $categoria->id == 4) {
                $categoria->update([
                    'descricao' => $request->input('descricao') ?? "",
                ]);
                throw new \Exception("Somente a descrição foi alterada, o nome não pode ser alterado");
            }
            $categoria->update([
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao') ?? "",
            ]);
            Alert::alert('Alteração', 'Categoria alterada com sucesso', 'success');
            return redirect()->route('administrativo.produto.categoria');
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.produto.categoria');
        }
    }
}
