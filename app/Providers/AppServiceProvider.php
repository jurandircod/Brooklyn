<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\{User, Estoque, ItemCarrinho};
use App\Observers\ItemCarrinhoObserver;
use App\Observers\EstoqueObserver;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ItemCarrinho::observe(ItemCarrinhoObserver::class);
        Estoque::observe(EstoqueObserver::class);
        User::observe(UserObserver::class);
    }
}
