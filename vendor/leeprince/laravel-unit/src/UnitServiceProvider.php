<?php
/**
 * [单元测试组件的服务提供者： laravel 项目的组件加载大部分都是通过服务提供者引导]
 *
 * @Author  leeprince:2020-07-05 15:07
 */

namespace LeePrince\Unit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * [单元测试服务提供者]
 *  可以借鉴：基于 laravel 开发的组件：laravel-admin、telescope
 *
 * @Author  leeprince:2020-07-06 18:25
 * @package LeePrince\Unit
 */
class UnitServiceProvider extends ServiceProvider
{
    public function register()
    {
        // dump('这是单元测试的服务提供者');
    }
    
    /**
     * [引导服务：该方法在所有服务提供者被注册以后才会被调用]
     *
     * @Author  leeprince:2020-03-22 19:55
     */
    public function boot()
    {
        $this->loadRoutes();
        $this->loadViews();
    }
    
    /**
     * [加载路由]
     *
     * @Author  leeprince:2020-03-23 00:28
     */
    private function loadRoutes()
    {
        Route::group(['namespace' => 'LeePrince\Unit\Http\Controllers', 'prefix' => 'unit', 'middleware' => 'web'], function() {
            $this->loadRoutesFrom(__DIR__.'/Route/route.php');
        });
    }
    
    /**
     * [加载视图]
     *
     * @Author  leeprince:2020-03-24 01:08
     */
    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__."/Resources/views/", 'unitview');
    }
}