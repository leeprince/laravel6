<?php

namespace App\Providers;

use App\MyPackage\Alipay;
use Illuminate\Support\ServiceProvider;

class MyContractsServerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 绑定单一实例
        $this->app->singleton('alipay', function($app) {
           return new Alipay();
        });

        // 绑定接口到实现: 以下3 种方案都可以！
        // $this->app->singleton(\App\MyContracts\Pay::class , function($app) {
        //     return new Alipay();
        // });
        // $this->app->bind(\App\MyContracts\Pay::class , function($app) {
        //     return new Alipay();
        // });
        $this->app->bind(\App\MyContracts\Pay::class , \App\MyPackage\Alipay::class);
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
