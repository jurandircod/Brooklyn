<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\produto;
use App\avaliacao;
use RealRashid\SweetAlert\Facades\Alert;
use App\ItemCarrinho;

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
        $estrela =  intVal($request->estrela);
        if ($estrela == null || $estrela < 1) {
            $estrela = 1;
        } elseif ($estrela > 5) {
            $estrela = 5;
        }
        $avaliacao = new Avaliacao;
        $avaliacao->user_id = $user->id;
        $avaliacao->produto_id = $produto->id;
        $avaliacao->estrela = $estrela;
        $avaliacao->comentario = $request->comentario;
        $avaliacao->save();

        // Calcula a nova média arredondada


        Alert::success('Avaliação salva com sucesso!');
        return redirect()->route('site.produto', ['id' => $produto->id]);
    }

    public function getAvaliacoes(Request $request)
    {
        $avaliacao = avaliacao::paginate(10);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('items.partials.items_list', compact('items'))->render(),
                'pagination' => $avaliacao->links()->toHtml()
            ]);
        }

        return view('items.index', compact('items'));
    }
}
