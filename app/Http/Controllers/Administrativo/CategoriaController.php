<?php

namespace App\Http\Controllers\Administrativo;
use App\Http\Controllers\Controller;
use App\Categoria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{

    private $categorias;

    public function __construct()
    {
        $this->categorias = Categoria::all();
    }

    public function index(){
        $categorias = $this->categorias;
        return view('administrativo.categoria', compact('categorias'));
    }

    public function salvarCategoria(Request $request)
    {
        $data = $request->all();
        $validator = $this->validarInput($data);
        Alert::alert('Categoria', 'Salva com sucesso', 'success');
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


    public function validarInput($request)
    {

        $validator = Validator::make($request, [
            'nome' => 'required|string|unique:categorias',
            'descricao' => 'required|string',
        ], [
            'nome.required' => 'O campo categoria é obrigatório',
            'nome.string' => 'O campo categoria deve ser uma string',
            'descricao.required' => 'O campo descricao é obrigatório',
            'descricao.string' => 'O campo descricao deve ser uma string',
            'nome.unique' => 'Já existe essa categoria cadastrada',
        ]);

        return $validator;
    }

    public function excluirCategoria(Request $request)
    {
        try {
            
            Categoria::findOrFail($request->input('categoria_id'));
            Categoria::where('id', $request->input('categoria_id'))->delete();
            Alert::alert('Exclusão', 'Categoria excluída com sucesso', 'success');
            return redirect()->route('administrativo.produto.categoria');
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.produto.categoria');
        }
    }

    public function alterarCategoria(Request $request)
    {
        try {
            Categoria::findOrFail($request->input('categoria_id'));
            Categoria::where('categoria', $request->input('categoria_id'))->update($request->all());
            Alert::alert('Alteração', 'Categoria alterada com sucesso', 'success');
            return redirect()->route('administrativo.produto.categoria');
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.produto.categoria');
        }
    }

    public function enviaFormAlterar(Request $request)
    {
        $categoriaAlter = Categoria::where('id', $request->input('categoria_id'))->get();
        return view('administrativo.categoria', compact('categoriaAlter'));
    }
}
