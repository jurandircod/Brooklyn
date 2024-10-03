<?php

namespace App\Http\Controllers;

use App\Contato;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        $contato = $request->query('contato');
        return view('site.contato')->with(['contato' => $contato]);
    }

    public function salvar(Request $request)
    {   
        $request->validate([
            'nome' => 'required|min:3|max:255',
            'sobrenome' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|numeric',
            'mensagem' => 'required|min:3|max:500',
        ],[
            'nome.required' => 'O nome é obrigatório',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres',
            'sobrenome.required' => 'O sobrenome é obrigatório',
            'sobrenome.min' => 'O sobrenome deve ter pelo menos 3 caracteres',
            'sobrenome.max' => 'O sobrenome deve ter no máximo 255 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email é inválido, por favor, informe um email válido',
            'email.max' => 'O email deve ter no máximo 255 caracteres',
            'telefone.required' => 'O telefone é obrigatório',
            'telefone.numeric' => 'O telefone é inválido',
            'mensagem.required' => 'A mensagem é obrigatória',
            'mensagem.min' => 'A mensagem deve ter pelo menos 3 caracteres',
            'mensagem.max' => 'A mensagem deve ter no máximo 500 caracteres',
        ]);
        
        Contato::create($request->all());
        Alert::alert('Contato', 'Salvo com sucesso', 'success');

        // Redireciona para a view com o SweetAlert
        return redirect()->route('site.contato');


        //$contato->nome = $request->query('nome');
        //$contato->sobrenome = $request->query('sobrenome');
        // $contato->email = $request->query('email');
        // $contato->telefone = $request->query('telefone');
        //$contato->mensagem = $request->query('mensagem');
        // $contato->save();
        //return redirect()->route('site.contato');
    }
}
