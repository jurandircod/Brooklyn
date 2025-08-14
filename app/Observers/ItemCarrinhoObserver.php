<?php

namespace App\Observers;

use App\Model\ItemCarrinho;
use App\Model\Estoque;

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
