<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MercadoPagoService;

class MercadoPagoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MercadoPagoService::class, function () {
            return new MercadoPagoService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
