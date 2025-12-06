<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{User, Estoque, ItemCarrinho};
use App\Observers\ItemCarrinhoObserver;
use App\Observers\EstoqueObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

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


        // FORÇAR HTTPS SEMPRE QUE ESTIVER NO NGROK
        if (Str::contains(request()->getHttpHost(), 'ngrok-free.app')) {
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }
    
    }
}
