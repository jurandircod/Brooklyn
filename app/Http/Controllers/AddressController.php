<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\model\{pedido, Endereco};
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Perfil;

class AddressController extends Controller
{
    private $activeTab = 6;

    public function __construct()
    {
        $this->middleware('auth');
    }

    static function index() {}

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
            return response()->json(['error' => 'Erro ao buscar o CEP', $e->getMessage()], 500);
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
            'numero' => 'required|max:20|numeric',
            'telefone' => 'required|min:3|numeric|digits_between:3,11',
            'cpf' => 'required|digits:11',
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
            'telefone.required' => 'O telefone é obrigatório',
            'telefone.min' => 'O telefone deve ter pelo menos 3 caracteres',
            'telefone.numeric' => 'O telefone é inválido',
            'telefone.digits_between' => 'o telefone deve ter entre 3 a 11 digitos',
            'numero.numeric' => 'O numero é inválido',
            'cpf.required' => 'O campo cpf é obrigatório',
            'cpf.digits' => 'O campo cpf deve ter 11 dígitos',
            'cpf.unique' => 'O campo cpf deve ser único',

        ]);

        return $validator;
    }

    /**
     * Salva um novo endereço para o usuário logado.
     *
     * Esta função recebe os dados do formulário de edição de endereços e os salva no banco de dados.
     *
     * Se houver algum erro de validação, a função redireciona para o formulário mantendo os dados e mostrando as mensagens de erro.
     *
     * Se houver algum erro de banco de dados, a função redireciona para o formulário mostrando a mensagem de erro.
     *
     * @param Request $request
     * @return Redirect
     */
    public function salvar(Request $request)
    {
        $data = $this->str_correct($request->all());
        $userId = Auth::user()->id;
        $count = Endereco::where('user_id', $userId)->count();
        if ($count >= 4) {
            Alert::alert('Erro', 'Limite de endereço atingido', 'error');
            return redirect()->route('site.perfil', ['activeTab' => 3])->withInput();
        }

        $data['user_id'] = $userId;
        // Chama a função de validação
        $validator = $this->validarInput($data);

        // Redireciona de volta para o formulário mantendo os dados
        if ($validator->fails()) {
            $activeTab = 3;
            return redirect()->route('site.perfil', ['activeTab' => $activeTab])
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Endereco::create($data);
            Alert::alert('Endereço', 'Salvo com sucesso', 'success');
            return redirect()->route('site.perfil', ['activeTab' => $this->activeTab]);
        } catch (\Exception $e) {
            Alert::alert('Erro', $e->getMessage(), 'error');
            return redirect()->route('site.perfil', ['activeTab' => $this->activeTab]);
        }
    }

    public function str_correct($data)
    {
        $data['cep'] = preg_replace('/[^0-9]/', '', $data['cep']);
        $data['cpf'] = str_replace(['.', '-'], '', $data['cpf']);
        $data['telefone'] = str_replace(['(', ')', ' ', '-'], '', $data['telefone']);
        return  $data;
    }

    /**
     * Atualiza um endereço existente com base nos dados recebidos via Request
     * 
     * @param Request $request
     * @param int $addressId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function updateAddress(Request $request, int $addressId)
    {
        $data = $this->str_correct($request->all());
        $validator = $this->validarInput($data);
        if ($validator->fails()) {
            return redirect()
                ->route('site.perfil', ['activeTab' => $this->activeTab])
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $address = Endereco::findOrFail($addressId);
            $address->fill($request->all());
            $address->save();
            return redirect()->route('site.perfil', ['activeTab' => 6]);
        } catch (\Exception $e) {
            return redirect()->route('site.perfil', ['activeTab' => $this->activeTab])->with([
                'error' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Disable an address with the given ID.
     *
     * If the address has related orders, its status will be set to "inactive".
     *
     * @param int $addressId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableAddress(int $addressId)
    {
        $address = Endereco::findOrFail($addressId);
        
            Alert::alert('Desativado', 'Endereço foi desativado', 'success');
            $address->status = 'inativo';
            $address->save();
        
            $address->delete();
            Alert::alert('Endereço', 'Removido com sucesso', 'success');

        return redirect()->route('site.perfil', ['activeTab' => 6]);
    }
}
