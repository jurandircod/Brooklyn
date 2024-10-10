<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use App\Permissoes;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class PermissoesController extends Controller
{
    public function index()
    {
        return view('administrativo.permissoes');
    }

    public function salvarPermissao(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'role' => 'required|numeric|min:0|max:10|unique:permissoes',
            'tipo_acesso' => 'required|string|unique:permissoes',
            'descricao' => 'required|string',
        ], [
            'role.required' => 'O campo role é obrigatório',
            'role.numeric' => 'O campo role deve ser numérico',
            'role.min' => 'O campo role deve ser maior que 0',
            'role.max' => 'O campo role deve ser menor que 10',
            'tipo_acesso.required' => 'O campo tipo de acesso é obrigatório',
            'tipo_acesso.string' => 'O campo tipo de acesso deve ser uma string',
            'descricao.required' => 'O campo descricao é obrigatório',
            'descricao.string' => 'O campo descricao deve ser uma string',
            'role.unique' => 'Já existe esse nível de permissão cadastrado',
            'tipo_acesso.unique' => 'Já existe um tipo de acesso com este nome',
        ]);


        Alert::alert('Permissão', 'Salva com sucesso', 'success');

        if ($validator->fails()) {
            Alert::alert('Endereço', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('administrativo.index')
                ->withErrors($validator)
                ->withInput();
        } else {
            Alert::alert('Permissão', 'Salva com sucesso', 'success');
            try{
                
                Permissoes::create($request->all());
                return redirect()->route('administrativo.index');
                
            }catch(\Exception $e){
                Alert::alert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.index');
            }
        }
    }
}
