<?php

namespace App\Observers;

use App\Estoque;

class EstoqueObserver
{

    public function saving(Estoque $estoque)
    {
        // Soma todos os campos de tamanho
        $quantidadrAtual = $estoque->quantidade;
        $quantidadeTotal = $estoque->quantidade =
            ($estoque->quantidadeP ?? 0) +
            ($estoque->quantidadeM ?? 0) +
            ($estoque->quantidadeG ?? 0) +
            ($estoque->quantidadeGG ?? 0) +
            ($estoque->quantidade775 ?? 0) +
            ($estoque->quantidade8 ?? 0) +
            ($estoque->quantidade825 ?? 0) +
            ($estoque->quantidade85 ?? 0) +
            ($estoque->quantidade ?? 0);
        $diferenca = $quantidadeTotal - $quantidadrAtual;
        if ($diferenca > 0) {
            $estoque->quantidade = $diferenca;
        }
    }
    /**
     * Handle the estoque "created" event.
     *
     * @param  \App\Estoque  $estoque
     * @return void
     */
    public function created(Estoque $estoque)
    {
        //           
        $estoque->quantidade = 0;
        $estoque->quantidade =
            ($estoque->quantidadeP ?? 0) +
            ($estoque->quantidadeM ?? 0) +
            ($estoque->quantidadeG ?? 0) +
            ($estoque->quantidadeGG ?? 0) +
            ($estoque->quantidade775 ?? 0) +
            ($estoque->quantidade8 ?? 0) +
            ($estoque->quantidade825 ?? 0) +
            ($estoque->quantidade85 ?? 0) +
            ($estoque->quantidade ?? 0);
    }

    /**
     * Handle the estoque "updated" event.
     *
     * @param  \App\Estoque  $estoque
     * @return void
     */
    public function updated(Estoque $estoque)
    {
        //
    }

    /**
     * Handle the estoque "deleted" event.
     *
     * @param  \App\Estoque  $estoque
     * @return void
     */
    public function deleted(Estoque $estoque)
    {
        //
    }

    /**
     * Handle the estoque "restored" event.
     *
     * @param  \App\Estoque  $estoque
     * @return void
     */
    public function restored(Estoque $estoque)
    {
        //
    }

    /**
     * Handle the estoque "force deleted" event.
     *
     * @param  \App\Estoque  $estoque
     * @return void
     */
    public function forceDeleted(Estoque $estoque)
    {
        //
    }
}
