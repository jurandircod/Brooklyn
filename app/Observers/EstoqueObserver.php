<?php

namespace App\Observers;

use App\Models\Estoque;

class EstoqueObserver
{

    protected $mapaTamanhoCamisas = [
        'quantidadeP' => 'p',
        'quantidadeM' => 'm',
        'quantidadeG' => 'g',
        'quantidadeGG' => 'gg',
    ];

    protected $mapaTamanhoSkates = [
        'quantidade775' => '775',
        'quantidade8' => '8',
        'quantidade825' => '825',
        'quantidade85' => '85',
    ];
    public function saving(Estoque $estoque)
    {

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
    }

    /**
     * Handle the estoque "updated" event.
     *
     * @param  \App\Estoque  $estoque
     * @return void
     */
    public function updated(Estoque $estoque)
    {
        if ($estoque->quantidade < 0) {
            $estoque->quantidade = 0;
        }        
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
