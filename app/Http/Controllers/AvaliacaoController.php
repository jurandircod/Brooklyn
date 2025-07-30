<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\produto;
use App\avaliacao;
use RealRashid\SweetAlert\Facades\Alert;

class AvaliacaoController extends Controller
{
    public function CreateAvaliacao(Request $request)
    {
        if (!$request->has('produto_id') || !$request->has('estrela') || !$request->has('comentario')) {
            Alert::error('Por favor, preencha todos os campos.');
            return redirect()->back();
        }

        $produto = Produto::findOrFail($request->produto_id);
        $user = auth()->user();

        $avaliacao = new Avaliacao;
        $avaliacao->user_id = $user->id;
        $avaliacao->produto_id = $produto->id;
        $avaliacao->estrela = $request->estrela;
        $avaliacao->comentario = $request->comentario;
        $avaliacao->save();

        // Calcula a nova média arredondada
        $mediaEstrelas = $this->calcularMediaEstrelas($produto->id);

        Alert::success('Avaliação salva com sucesso!');
        return redirect()->route('site.produto', ['id' => $produto->id])->with('mediaEstrelas', $mediaEstrelas);
    }

    // Função para calcular a média (pode ser usada em outros lugares)
    private function calcularMediaEstrelas($produtoId)
    {
        $media = Avaliacao::where('produto_id', $produtoId)
            ->avg('estrela');

        return round($media); // Arredonda para inteiro (1-5)
    }

    // Se quiser chamar via AJAX/API
    public function getMediaEstrelas($produtoId)
    {
        $media = $this->calcularMediaEstrelas($produtoId);

        return response()->json([
            'media_estrelas' => $media
        ]);
    }
}
