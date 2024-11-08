<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\marca;
use Illuminate\Http\Request;

class marcaController extends Controller
{

    private $marca;

    public function __construct()
    {
        $this->marca = marca::all();
    }

    public function index()
    {
        $marcas = $this->marca;
        return view('administrativo.marca', compact('marcas'));
    }

    public function marcaSalvar(Request $request)
    {
        $data = $request->all();
        $validator = $this->validarInput($data);
        Alert::alert('Marca', 'Salva com sucesso', 'success');
        if ($validator->fails()) {
            Alert::alert('Marca', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('administrativo.marca')
                ->withErrors($validator)
                ->withInput();
        } else {
            Alert::alert('Marca', 'Salva com sucesso', 'success');
            try {
                marca::create($request->all());
                return redirect()->route('administrativo.marca');
            } catch (\Exception $e) {
                Alert::alert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.marca');
            }
        }
    }

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

    public function marcaAlterar(Request $request)
    {
        try {
            $marca = marca::findOrFail($request->input('marca_id'));
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

    public function marcaEnviarForm(Request $request)
    {
        $marcaAlter = $this->marca->find($request->input('id'));
        $marcas = $this->marca;
        return view('administrativo.marca', compact('marcaAlter', 'marcas'));
    }
}
