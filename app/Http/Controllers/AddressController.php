<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Endereco;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        }
    }

    public function getCityByCep($cep)
    {

        // Remover caracteres não numéricos do CEP
        $cep = preg_replace('/[^0-9]/', '', $cep);

        // Validar o CEP (8 dígitos)
        if (strlen($cep) !== 8) {
            return response()->json(['error' => 'CEP inválido'], 400);
        }

        $client = new Client(['verify' => false]);
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);


            // Verifica se o CEP é inválido ou não foi encontrado
            if (isset($data['erro'])) {
                Alert::alert('Erro', "saf", 'error');
                return response()->json(['error' => 'CEP não encontrado'], 404);
            }

            // Retorna a cidade ou uma mensagem de erro
            $city = $data['localidade'] ?? 'Cidade não disponível para este CEP';
            $uf = $data['uf'] ?? 'UF não disponível para este CEP';
            return response()->json(['city' => $city, 'uf' => $uf]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar o CEP Informar o Jurandir'], 500);
        }
    }
    
    public function validarInput($request)
    {
        
        $validator = Validator::make($request, [
            'bairro' => 'required|min:3|max:255',
            'cidade' => 'required|min:3|max:255',
            'estado' => 'required|min:2|max:255',
            'cep' => 'required|digits:8',
            'logradouro' => 'required|min:3|max:255',
            'numero' => 'required|max:255|numeric',
            'complemento' => 'required|min:3|max:255',
            'telefone' => 'required|min:3|numeric',
        ], [
            // Mensagens de erro personalizadas
            'bairro.required' => 'O bairro é obrigatório',
            'bairro.min' => 'O bairro deve ter pelo menos 3 caracteres',
            'bairro.max' => 'O bairro deve ter no máximo 255 caracteres',
            'cidade.required' => 'A cidade é obrigatória',
            'cidade.min' => 'A cidade deve ter pelo menos 3 caracteres',
            'cidade.max' => 'A cidade deve ter no máximo 255 caracteres',
            'estado.required' => 'O estado é obrigatório',
            'estado.min' => 'O estado deve ter pelo menos 2 caracteres',
            'estado.max' => 'O estado deve ter no máximo 255 caracteres',
            'cep.required' => 'O cep é obrigatório',
            'cep.digits' => 'O cep deve ter 8 dígitos',
            'logradouro.required' => 'O logradouro é obrigatório',
            'logradouro.min' => 'O logradouro deve ter pelo menos 3 caracteres',
            'logradouro.max' => 'O logradouro deve ter no máximo 255 caracteres',
            'numero.required' => 'O numero é obrigatório',
            'numero.max' => 'O numero deve ter no máximo 255 caracteres',
            'complemento.required' => 'O complemento é obrigatório',
            'complemento.min' => 'O complemento deve ter pelo menos 3 caracteres',
            'complemento.max' => 'O complemento deve ter no máximo 255 caracteres',
            'telefone.required' => 'O telefone é obrigatório',
            'telefone.min' => 'O telefone deve ter pelo menos 3 caracteres',
            'telefone.numeric' => 'O telefone é inválido',
            'numero.numeric' => 'O numero é inválido',
        ]);

        return $validator;
    }

    public function salvar(Request $request)
    {
        $activeTab = 3;
        $cepTratado = preg_replace('/[^0-9]/', '', $request->cep);
        $data = $request->all();
        $data['cep'] = $cepTratado;
        $data['user_id'] = Auth::user()->id;

        // Chama a função de validação
        $validator = $this->validarInput($data);

        if ($validator->fails()) {
            Alert::alert('Endereço', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('site.perfil', compact('activeTab'))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Endereco::create($data);
            Alert::alert('Endereço', 'Salvo com sucesso', 'success');
            return redirect()->route('site.perfil', compact('activeTab'));
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('site.perfil', compact('activeTab'));
        }
    }

    public function editar(Request $request, $id)
    {
        $activeTab = 3;
        

        // Chama a função de validação
        $validator = $this->validarInput($request->all());

        if ($validator->fails()) {
            Alert::alert('Endereço', 'Preencha os campos obrigatórios', 'error');
            return redirect()
                ->route('site.perfil', compact('activeTab'))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $endereco = Endereco::findOrFail($id);
            $endereco->update($request->all());

            Alert::alert('Endereço', 'Atualizado com sucesso', 'success');
            return redirect()->route('site.perfil', compact('activeTab'));
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return view('site.perfil', compact('activeTab'));
        }
    }

    public function enviaParaformEnderecos(Request $request, $id)
    {
        $enderecos = Endereco::where('id', $id)->get();
        $activeTab = 3;
        $enderecosMostrar = Endereco::where('user_id', Auth::user()->id)->get();
        $enderecoEditar = Endereco::where('id', $id)->first();
        return view('site.perfil', compact('activeTab', 'enderecoEditar', 'enderecos', 'enderecosMostrar'));

    }

    public function exibirEndereco()
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        } else {
            $enderecos = Endereco::where('user_id', Auth::user()->id)->get();
            return view('site.perfil', compact('enderecosMostrar'));
        }
    }

    public function remover($id)
    {
        $activeTab = 6;
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();
        Alert::alert('Endereço', 'Removido com sucesso', 'success');
        return redirect()->route('site.perfil.exibirEndereco', compact('activeTab'));
    }
}
