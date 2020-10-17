<?php

namespace LeePrince\LaravelWechatShop\Wap\Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * 路由的配置信息
     */
    private $routeConfig = [
        // 定义访问路由的域名
        // 'domain' => config('leeprince.com', null),
        'namespace'  => 'LeePrince\LaravelWechatShop\Wap\Shop\Http\Controllers',
        'prefix'     => 'LaravelWechatShopWapShop',
        'middleware' => 'web'
    ];
    
    /**
     * @var array 组件中中引入其他组件的中间件
     */
    private $middlewareGroups = [];
    private $routeMiddleware  = [
        // 在 leeprince/laravel-wechat-shop 组件中引入
        'wechat.oauth' => \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class,
    ];
    
    public function register()
    {
        // dump('这是单元测试的服务提供者');
        
        $this->registerConfigFile();
        $this->registerRouteMiddleware();
        $this->registerConfigFilePublishing();
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
     * [注册配置文件]
     *
     * @Author  leeprince:2020-07-14 13:07
     */
    private function registerConfigFile()
    {
        // 将给定配置与现有配置合并。
        // 指定的 key = 配置的文件名。即可让配置文件合并到由 $this->publishes([__DIR__ . '/Config' => config_path()], $groups = null); 分配的由文件名组成的同一个组中
        $this->mergeConfigFrom(__DIR__ . "/../Config/leeprince-shop.php", 'wap.shop');
    }
    
    /**
     * [组件中引入其他组件的中间件]
     *
     * @Author  leeprince:2020-07-14 12:42
     */
    private function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }
        
        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }
    
    /**
     * [加载路由]
     *
     * @Author  leeprince:2020-03-23 00:28
     */
    private function loadRoutes()
    {
        Route::group($this->routeConfig, function () {
            $this->loadRoutesFrom(__DIR__ . '/../Route/route.php');
        });
    }
    
    /**
     * [加载视图]
     *
     * @Author  leeprince:2020-03-24 01:08
     */
    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . "/../Resources/views/", 'WapShopView');
    }
    
    /**
     * [执行 vendor:publish 命令发布配置文件到指令目录，即可以发布配置文件到指定目录，达到允许外部修改配置文件信息的目的]
     *      执行：php artisan vendor:publish --provider="LeePrince\LaravelWechatShop\Wap\Shop\Providers\ShopServiceProvider"
     *
     * @Author  leeprince:2020-03-25 00:43
     */
    private function registerConfigFilePublishing()
    {
        // 确定应用程序是否正在控制台中运行。
        if ($this->app->runningInConsole()) {
            /**
             * 注册要由 publish 命令发布的路径，可以发布配置文件到指定目录;
             *      config_path()
             *          1. 不填就是默认的地址 config_path 的路径, 发布配置文件名不会改变;
             *          2. 不带后缀就是一个文件夹
             *          3. 如果是一个后缀就是一个文件
             *      publishes() 的第二个参数是这个配置文件的标识，可以为null或者任意字符
             */
            $this->publishes([__DIR__ . '/../Config' => config_path()], null);
            $this->publishes([__DIR__ . '/../Resources/views/assets' => public_path('/vendor/leeprince/laravel-wechat-shop/')], null);
        }
    }
}