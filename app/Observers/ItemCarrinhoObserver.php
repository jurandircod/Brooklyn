<?php

namespace App\Observers;

use App\ItemCarrinho;
use App\Estoque;

class ItemCarrinhoObserver
{
    /**
     * Handle the item carrinho "created" event.
     *
     * @param  \App\ItemCarrinho  $itemCarrinho
     * @return void
     */
    public function created(ItemCarrinho $itemCarrinho)
    {
        //
    }

    /**
     * Handle the item carrinho "updated" event.
     *
     * @param  \App\ItemCarrinho  $itemCarrinho
     * @return void
     */
    public function updated(ItemCarrinho $itemCarrinho)
    {
        //
    }

    /**
     * Handle the item carrinho "deleted" event.
     *
     * @param  \App\ItemCarrinho  $itemCarrinho
     * @return void
     */
    public function deleted(ItemCarrinho $itemCarrinho)
    {
        try {
        $itemCarrinho->tamanho;
        $itemCarrinho->quantidade;
        $estoque = Estoque::where('produto_id', $itemCarrinho->produto_id)->first();
        switch ($itemCarrinho->tamanho) {
            case "P":
                $estoque->quantidadeP += $itemCarrinho->quantidade;
                break;
            case "M":
                $estoque->quantidadeM += $itemCarrinho->quantidade;
                break;
            case "G":
                $estoque->quantidadeG += $itemCarrinho->quantidade;
                break;
            case "GG":
                $estoque->quantidadeGG += $itemCarrinho->quantidade;
                break;
            case "775":
                $estoque->quantidade775 += $itemCarrinho->quantidade;
                break;
            case "8":
                $estoque->quantidade8 += $itemCarrinho->quantidade;
                break;
            case "825":
                $estoque->quantidade825 += $itemCarrinho->quantidade;
                break;
            case "85":
                $estoque->quantidade85 += $itemCarrinho->quantidade;
                break;
            default:
                break;
        }
        $estoque->save();
        } catch (\Exception $e) {
            // Se não tiver estoque, retorna erro
            return response()->json([
                'status' => 'error',
                'message' => 'Estoque não encontrado'
            ]);
        }
    }

    /**
     * Handle the item carrinho "restored" event.
     *
     * @param  \App\ItemCarrinho  $itemCarrinho
     * @return void
     */
    public function restored(ItemCarrinho $itemCarrinho)
    {
        //
    }

    /**
     * Handle the item carrinho "force deleted" event.
     *
     * @param  \App\ItemCarrinho  $itemCarrinho
     * @return void
     */
    public function forceDeleted(ItemCarrinho $itemCarrinho)
    {
        //
    }
}
