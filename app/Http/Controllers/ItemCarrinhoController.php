<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrinho;
use App\ItemCarrinho;
use App\Produtos;
use App\Estoque;
use Illuminate\Support\Facades\Auth;

class ItemCarrinhoController extends Controller
{
    public function adicionar(Request $request)
    {


        $user_id = auth()->id() ?? 1; // ID de fallback

        // Busca ou cria o carrinho do usuário
        $carrinho = Carrinho::firstOrCreate(
            ['user_id' => $user_id],
        );

        try {

            $produto = Produtos::findOrFail($request->produto_id);
            $estoque = new Estoque;
            $estoqueProduto = $estoque->listarEstoque($produto->id);


            if (isset($estoqueProduto)) {
                // Verifica se o estoque está cheio
                if ($estoqueProduto->quantidade < $request->input('quantidade', 1)) {
                    // Se não estiver cheio, verifica se o estoque tem espaço
                    return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
                }
            } else {
                // Se não tiver estoque, retorna erro
                return response()->json(['status' => 'error', 'message' => 'Estoque insuficiente!']);
            }

            // Verifica se já existe o mesmo produto no carrinho
            $itemExistente = ItemCarrinho::where('carrinho_id', $carrinho->id)
                ->where('produto_id', $produto->id)
                ->first();

            if ($itemExistente) {
                // Atualiza a quantidade
                $itemExistente->quantidade += $request->input('quantidade', 1);
                $itemExistente->save();
                return response()->json(['status' => 'sucess', 'message' => 'Produto adicionado ao carrinho!']);
                exit();
            } else {
                // Cria novo item
                ItemCarrinho::create([
                    'carrinho_id' => $carrinho->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $request->input('quantidade', 1),
                    'preco_unitario' => $produto->valor,
                    'tamanho' => $estoqueProduto->quantidade, // se usar
                ]);
                return response()->json(['status' => 'sucess', 'message' => 'Produto adicionado ao carrinho!']);
                exit();
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => "$e"]);
        }
    }

    public function quantidadeItensCarrinho()
    {
        $carrinho = Carrinho::where('user_id', Auth::id())->first();

        if ($carrinho) {
            $quantidade = ItemCarrinho::where('carrinho_id', $carrinho->id)->count();
            return response()->json(['quantidade' => $quantidade]);
        }

        return response()->json(['quantidade' => 0]);
    }
}
