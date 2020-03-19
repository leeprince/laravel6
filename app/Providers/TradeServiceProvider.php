<?php

namespace App\Providers;

use App\MyPackage\Trade;
use Illuminate\Support\ServiceProvider;

class TradeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('trade', function ($app) {
           return new Trade();
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
