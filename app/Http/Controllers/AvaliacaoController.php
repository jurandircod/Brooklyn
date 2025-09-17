<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\model\{Produto, Avaliacao};
use Illuminate\Support\Facades\DB;

class AvaliacaoController extends Controller
{
    public function createAvaliacao(Request $request)
    {
        try {
            if (!$request->has('produto_id') || !$request->has('estrela') || !$request->has('comentario')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Erro ao salvar avaliação!'
                ]);
            }

            DB::beginTransaction();
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
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Avaliação salva com sucesso!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao salvar avaliação: ' . $e->getMessage()
            ]);
        }
    }

    public function getAvaliacoes(Request $request)
    {
        $avaliacao = Avaliacao::paginate(10);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('items.partials.items_list', compact('items'))->render(),
                'pagination' => $avaliacao->links()->toHtml()
            ]);
        }

        return view('items.index', compact('items'));
    }
}
