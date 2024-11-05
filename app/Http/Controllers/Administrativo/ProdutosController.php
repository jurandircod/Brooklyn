<?php

namespace App\Http\Controllers\Administrativo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Produto;

class ProdutosController extends Controller
{
    public function index()
    {
        return view('administrativo.produtoAcessorio');
    }

    public function salvarAcessorio(Request $request)
    {
        dd($request->input('cores'));
        
        $data = $request->all();
        $validator = $this->validarInput($data);

        Alert::alert('Produto', 'Salva com sucesso', 'success');
        if ($validator->fails()) {
            Alert::alert('Endereço', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('administrativo.produto.acessorio')
                ->withErrors($validator)
                ->withInput();
        } else {
            Alert::alert('Produto', 'Salva com sucesso', 'success');
            try {
                Produto::create($request->all());
                return redirect()->route('administrativo.produto.acessorio');
            } catch (\Exception $e) {
                Alert::alert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.produto.acessorio');
            }
        }
    }

    public function validarInput($request)
    {

        $validator = Validator::make($request, [
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'cor' => 'required|string',
            'tamanho_acesso' => 'required|numeric',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser uma string',
            'descricao.required' => 'O campo descricao é obrigatório',
            'descricao.string' => 'O campo descricao deve ser uma string',
            'cor.required' => 'O campo cor é obrigatório',
            'cor.string' => 'O campo cor deve ser uma string',
            'tamanho_acesso.required' => 'O campo tamanho_acesso é obrigatório',
            'tamanho_acesso.numeric' => 'O campo tamanho_acesso deve ser numérico',
        ]);

        return $validator;
    }
}
