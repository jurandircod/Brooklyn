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

    public function saving(ItemCarrinho $itemCarrinho)
    {
        $tamanhoMap = [
            'P' => 'quantidadeP',
            'M' => 'quantidadeM',
            'G' => 'quantidadeG',
            'GG' => 'quantidadeGG',
            '775' => 'quantidade775',
            '8' => 'quantidade8',
            '825' => 'quantidade825',
            '85' => 'quantidade85',
            'quantidade' => 'quantidade',
        ];

        if (!array_key_exists($itemCarrinho->tamanho, $tamanhoMap)) {
            throw new \Exception('Tamanho inválido!');
        }

        $itemCarrinho->tamanho;
        $itemCarrinho->quantidade;
        $estoque = $itemCarrinho->produto->estoque;
        $campoTamanho = $tamanhoMap[$itemCarrinho->tamanho];
        if ($itemCarrinho->quantidade > $estoque->$campoTamanho) {
            $itemCarrinho->quantidade = $estoque->$campoTamanho;
        }
    }
    /**
     * Handle the item carrinho "updated" event.
     *
     * @param  \App\ItemCarrinho  $itemCarrinho
     * @return void
     */
    public function updated(ItemCarrinho $itemCarrinho) {}

    /**
     * Handle the item carrinho "deleted" event.
     *
     * @param  \App\ItemCarrinho  $itemCarrinho
     * @return void
     */
    public function deleted(ItemCarrinho $itemCarrinho)
    {

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
