<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\model\{Marca, Notificacao};
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    private $notificacaoContador;
    private $notificacao;


    private $marca;

    public function __construct()
    {
        $this->marca = marca::all();
        $this->notificacaoContador = notificacao::NotificacaoContador();
        $this->notificacao = notificacao::notificacaoPedido();
    }

    public function index()
    {
        $marcas = $this->marca;
        $notificacaoContador = $this->notificacaoContador;
        $notificacao = $this->notificacao;
        return view('administrativo.marca', compact('marcas', 'notificacaoContador', 'notificacao'));
    }

    /**
     * Salva uma marca com os dados passados por parâmetro.
     * Valida os dados e caso haja algum erro, retorna para a página de marca com os erros.
     * Caso os dados sejam válidos, salva a marca e retorna para a página de marca com um alert de sucesso.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function marcaSalvar(Request $request)
    {
        if ($request->has('rotaProduto')) {
            $marca = $request->all();
            $dataRotaProduto['nome'] = $marca['nomeMarca'];
            $dataRotaProduto['descricao'] = $marca['descricaoMarca'];
            $validator = $this->validarInput($dataRotaProduto);
        } else {

            $validator = $this->validarInput($request->all());
        }
        if ($validator->fails()) {
            Alert::alert('Marca', 'Preencha os campos obrigatórios', 'error');
            if ($request->has('rotaProduto')) {
                return redirect()->route('administrativo.produtos')->withInput();
            } else {
                return redirect()
                    ->route('administrativo.marca')
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            Alert::alert('Marca', 'Salva com sucesso', 'success');
            try {
                if ($request->has('rotaProduto')) {
                    marca::create($dataRotaProduto);
                    Alert::alert('Marca', 'Salva com sucesso', 'success');
                    return redirect('administrativo/produtos')->withInput();
                } else {
                    marca::create($request->all());
                    Alert::alert('Marca', 'Salva com sucesso', 'success');
                    return redirect()->route('administrativo.marca');
                }
            } catch (\Exception $e) {
                Alert::alert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.marca');
            }
        }
    }

    /**
     * Valida os dados de entrada do produto.
     *
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     *
     * Valida os dados de entrada do produto, verificando se os campos nome e descricao
     * est o preenchidos.
     */
    public function validarInput($request)
    {
        $validator = Validator::make($request, [
            'nome' => 'required',
            'descricao' => 'required',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'descricao.required' => 'O campo descricao é obrigatório',
        ]);

        return $validator;
    }


    /**
     * Exclui uma marca existente
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function marcaExcluir(Request $request)
    {
        try {
            $marca = marca::findOrFail($request->input('id'));
            $marca->delete();
            Alert::alert('Exclusão', 'Peça excluída com sucesso', 'success');
            return redirect()->route('administrativo.marca')->with('success', 'Peça excluída com sucesso.');
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.marca');
        }
    }

    /**
     * Altera uma marca existente
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */

    public function marcaAlterar(Request $request)
    {
        try {
            $marca = marca::findOrFail($request->input('id'));
            $marca->update([
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
            ]);
            Alert::alert('Alteração', 'Peça alterada com sucesso', 'success');
            return redirect()->route('administrativo.marca')->with('success', 'Peça alterada com sucesso.');
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.marca');
        }
    }
}
