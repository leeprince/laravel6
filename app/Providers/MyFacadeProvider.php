<?php

namespace App\Providers;

use App\Http\Controllers\FacadeController;
use Illuminate\Support\ServiceProvider;

class MyFacadeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('index', function($app) {
           return new FacadeController();
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
