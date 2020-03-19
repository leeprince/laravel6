<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // 所有视图共享数据
        View::share(['shareData' => '我是应用服务者（AppServiceProvider）的共享数据']);

        // 监听所有 sql 执行
        DB::listen(function ($query) {
            dump($query->sql);
            print_r($query->bindings);
            // dump($query->bindings);
            // dump($query->time);
        });

    }
}
