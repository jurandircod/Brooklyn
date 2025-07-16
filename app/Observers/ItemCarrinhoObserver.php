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
            $estoque = $itemCarrinho->produto->estoque;
            switch ($itemCarrinho->tamanho) {
                case "P":
                    $estoque->quantidadeP += $itemCarrinho->quantidade;
                    $estoque->quantidade += $estoque->quantidadeP;
                    break;
                case "M":
                    $estoque->quantidadeM += $itemCarrinho->quantidade;
                    $estoque->quantidade += $estoque->quantidadeM;
                    break;
                case "G":
                    $estoque->quantidadeG += $itemCarrinho->quantidade;
                    $estoque->quantidade += $estoque->quantidadeG;
                    break;
                case "GG":
                    $estoque->quantidadeGG += $itemCarrinho->quantidade;
                    $estoque->quantidade += $estoque->quantidadeGG;
                    break;
                case "775":
                    $estoque->quantidade775 += $itemCarrinho->quantidade;
                    $estoque->quantidade += $estoque->quantidade775;
                    break;
                case "8":
                    $estoque->quantidade8 += $itemCarrinho->quantidade;
                    $estoque->quantidade += $estoque->quantidade8;
                    break;
                case "825":
                    $estoque->quantidade825 += $itemCarrinho->quantidade;
                    $estoque->quantidade += $estoque->quantidade825;
                    break;
                case "85":
                    $estoque->quantidade85 += $itemCarrinho->quantidade;
                    $estoque->quantidade += $estoque->quantidade85;
                    break;
                case "quantidade":
                    $estoque->quantidade += $itemCarrinho->quantidade;
                    break;
                default:
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Tamanho inválido!'
                    ]);
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
