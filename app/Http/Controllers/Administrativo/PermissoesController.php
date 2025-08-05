<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Model\{Permissao, User};
use Illuminate\Support\Facades\Auth;

class PermissoesController extends Controller
{
    private $permissoes;
    private $usuarios;

    public function __construct()
    {
        $this->permissoes = Permissao::all();
        $this->usuarios = User::all();
    }

    public function validarInput($request)
    {

        $validator = Validator::make($request, [
            'role_id' => 'required|numeric|min:0|max:10|unique:permissoes',
            'tipo_acesso' => 'required|string|unique:permissoes',
            'descricao' => 'required|string',
        ], [
            'role_id.required' => 'O campo role é obrigatório',
            'role_id.numeric' => 'O campo role deve ser numérico',
            'role_id.min' => 'O campo role deve ser maior que 0',
            'role_id.max' => 'O campo role deve ser menor que 10',
            'tipo_acesso.required' => 'O campo tipo de acesso é obrigatório',
            'tipo_acesso.string' => 'O campo tipo de acesso deve ser uma string',
            'descricao.required' => 'O campo descricao é obrigatório',
            'descricao.string' => 'O campo descricao deve ser uma string',
            'role_id.unique' => 'Já existe esse nível de permissão cadastrado',
            'tipo_acesso.unique' => 'Já existe um tipo de acesso com este nome',
        ]);

        return $validator;
    }

    public function permissoes()
    {
        $permissoes = $this->permissoes;
        return view('administrativo.permissoes', compact('permissoes'));
    }

    public function salvarPermissao(Request $request)
    {
        $data = $request->all();

        $validator = $this->validarInput($data);

        Alert::alert('Permissão', 'Salva com sucesso', 'success');
        if ($validator->fails()) {
            Alert::alert('Endereço', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('administrativo.permissoes')
                ->withErrors($validator)
                ->withInput();
        } else {
            Alert::alert('Permissão', 'Salva com sucesso', 'success');
            try {
                Permissao::create($request->all());
                return redirect()->route('administrativo.permissoes');
            } catch (\Exception $e) {
                Alert::alert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.permissoes');
            }
        }
    }

    public function enviarPermissao(Request $request)
    {

        $permissoes = $this->permissoes;
        $id = $request->input('role_id');
        $permissao = Permissao::find($id);
        return view('administrativo.permissoes', compact('permissao', 'permissoes'));
    }

    public function removerPermissao(Request $request)
    {
        try {
            $id = $request->input('role_id');
            // verifica se o usuário possui permissão
            $usuarioAtivo = User::where('role_id', $id)->get();
            $permissao = Permissao::find($id);
            if ($usuarioAtivo->isEmpty()) {
                $permissao->delete();
                Alert::alert('Exclusão', 'Permissão excluída com sucesso', 'success');
                return redirect()->route('administrativo.permissoes', compact('permissoes'));
            } else {
                Alert::alert('Erro', 'Não é possível excluir essa permissão, pois possui usuários associados', 'error');
                return redirect()->route('administrativo.permissoes', compact('permissoes'));
            }
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.permissoes', compact('permissoes'));
        }
    }


    public function editarPermissao(Request $request)
    {
        
        try {
            // pega o valor antigo do id para atualizar
            $idEditar = $request->input('idEditar');
            // pega informações para exibir a tabela permissoes na view        
            $permissoes = $this->permissoes;
            // pega o valor da role_id antiga
            $permissao = Permissao::where('role_id', $idEditar)->first();

            $data = $request->all();
            // insere os novos dados na tabela permissoes
            $permissao->update($data);
            Alert::alert('Permissão', 'Permissão editada com sucesso', 'success');
            return redirect()->route('administrativo.permissoes', compact('permissao', 'permissoes'));
        } catch (\Exception $e) {

            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.permissoes', compact('permissoes'));
        }
    }
    public function permissoesUsuarios()
    {
        
        if (Auth::check()) {
            $permissoesUser = Permissao::where('role_id', Auth::user()->role_id)->get();
        } else {
            $permissoesUser = collect(); 
        }

        $permissoes = $this->permissoes;
        $usuarios = $this->usuarios;
        return view('administrativo.permissoesUsuarios', compact('usuarios', 'permissoes', 'permissoesUser'));
    }
    
    public function editarUsuarioPermissao(Request $request)
    {
        try {
            // pega o valor antigo do id para atualizar
            $idEditar = $request->input('role_id_alter');
            $idUser = $request->input('user_id');
            $user = User::findOrFail($idUser);
            $user->update([
                'role_id' => $idEditar,
            ]);
            // insere os novos dados na tabela permissoes
            Alert::alert('Permissão', 'Permissão editada com sucesso', 'success');
            return redirect()->route('administrativo.permissoes.usuarios');
        } catch (\Exception $e) {

            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.permissoes.usuarios');
        }
    }
}
