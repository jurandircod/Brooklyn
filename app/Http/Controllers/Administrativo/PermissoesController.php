<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\{Permissao, User, Notificacao};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissoesController extends Controller
{

    private $notificacaoContador;
    private $notificacao;
    public function __construct()
    {
        $this->notificacaoContador = notificacao::NotificacaoContador();
        $this->notificacao = notificacao::notificacaoPedido();
    }
    /**
     * Valida os dados de entrada ao cadastrar/editar permissões.
     * 
     * @param array $request Dados recebidos da requisição
     * @return \Illuminate\Contracts\Validation\Validator
     */
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

    /**
     * Exibe a lista de permissões cadastradas com paginação.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $permissoes = Permissao::paginate(10);
        $notificacaoContador = $this->notificacaoContador;
        $notificacao = $this->notificacao;
        return view('administrativo.permissoes', ['permissoes' => $permissoes, 'notificacaoContador' => $notificacaoContador, 'notificacao' => $notificacao]);
    }

    /**
     * Salva uma nova permissão no banco de dados.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(Request $request)
    {
        $data = $request->all();
        $validator = $this->validarInput($data);

        if ($validator->fails()) {
            $this->enviarAlert('Endereço', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('administrativo.permissoes')
                ->withErrors($validator)
                ->withInput();
        } else {
            try {
                Permissao::create($request->all());
                $this->enviarAlert('Permissão', 'Salva com sucesso', 'success');
                return redirect()->route('administrativo.permissoes');
            } catch (\Exception $e) {
                $this->enviarAlert('Erro', $e->getMessage(), 'error');
                return redirect()->route('administrativo.permissoes');
            }
        }
    }

    /**
     * Remove uma permissão caso não esteja associada a nenhum usuário.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remover(Request $request)
    {
        $id = intval($request->input('role_id'));
        $usuarioAtivo = User::where('role_id', $id)->get();
        $permissao = Permissao::find($id);

        try {
            if ($permissao) {
                if ($usuarioAtivo->isEmpty()) {
                    $permissao->delete();
                    $this->enviarAlert('Exclusão', 'Permissão excluída com sucesso', 'success');
                } else {
                    $this->enviarAlert('Erro', 'Não é possível excluir essa permissão, pois possui usuários associados', 'error');
                }
            } else {
                $this->enviarAlert('Erro', 'Não é possível excluir essa permissão, pois não existe', 'error');
            }

            return redirect()->route('administrativo.permissoes');
        } catch (\Exception $e) {
            $this->enviarAlert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.permissoes');
        }
    }

    /**
     * Edita ou cria uma permissão no banco de dados.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editar(Request $request)
    {
        try {
            $data = $request->all();
            DB::transaction(function () use ($data) {
                $permissao = Permissao::find($data['role_id']);

                if ($permissao) {
                    // Atualiza permissão existente
                    $permissao->tipo_acesso = $data['tipo_acesso'];
                    $permissao->descricao = $data['descricao'];
                    $permissao->save();
                } else {
                    // Cria nova permissão caso não exista
                    $permissao = new Permissao();
                    $permissao->role_id = $data['role_id'];
                    $permissao->tipo_acesso = $data['tipo_acesso'];
                    $permissao->descricao = $data['descricao'];
                    $permissao->save();
                }
            });

            $this->enviarAlert('Permissão', 'Permissão editada com sucesso', 'success');
            return redirect()->route('administrativo.permissoes');
        } catch (\Exception $e) {
            $this->enviarAlert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.permissoes');
        }
    }

    /**
     * Exibe a tela de permissões por usuário.
     * 
     * @return \Illuminate\View\View
     */
    public function permissoesUsuarios()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            $permissoesUser = Permissao::where('role_id', Auth::user()->role_id)->get();
        } catch (\Exception $e) {
            $this->enviarAlert('Erro', $e->getMessage(), 'error');
            return redirect()->route('login');
        }

        $notificacaoContador = $this->notificacaoContador;
        $notificacao = $this->notificacao;
        $permissoes = Permissao::all();
        $usuarios = User::with('permissao')->paginate(10);
        if ($usuarios === null) {
            $this->enviarAlert('Erro', 'Erro ao buscar usuários', 'error');
            return redirect()->route('login');
        }

        return view('administrativo.permissoesUsuarios', compact('usuarios', 'permissoes', 'notificacaoContador', 'notificacao'));
    }
    /**
     * Atualiza a permissão de um usuário específico.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editarUsuarioPermissao(Request $request)
    {
        try {
            $idEditar = $request->input('role_id_alter');
            $idUser = $request->input('user_id');
            $user = User::findOrFail($idUser);

            $user->update([
                'role_id' => $idEditar,
            ]);

            $this->enviarAlert('Permissão', 'Permissão editada com sucesso', 'success');
            return redirect()->route('administrativo.permissoes.usuarios');
        } catch (\Exception $e) {
            $this->enviarAlert('Erro', $e->getMessage(), 'error');
            return redirect()->route('administrativo.permissoes.usuarios');
        }
    }

    /**
     * Função utilitária para centralizar o envio de alerts ao frontend.
     * 
     * @param string $titulo  Título do alert
     * @param string $mensagem Mensagem exibida
     * @param string $tipo Tipo do alerta (success, error, warning, info)
     * @return void
     */
    private function enviarAlert($titulo, $mensagem, $tipo = 'info')
    {
        Alert::alert($titulo, $mensagem, $tipo);
    }
}
