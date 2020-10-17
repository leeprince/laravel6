<?php

namespace LeePrince\LaravelWechatShop\Wap\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class MemberServiceProvider extends ServiceProvider
{
    /**
     * 路由的配置信息
     */
    private $routeConfig = [
        // 定义访问路由的域名
        // 'domain' => config('leeprince.com', null),
        'namespace'  => 'LeePrince\LaravelWechatShop\Wap\Member\Http\Controllers',
        'prefix'     => 'LaravelWechatShopWapMember',
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
    
    /*
     * 自定义 Artisan 命令，包含以下功能
     *      1. 执行数据库迁移功能：php artisan migrate(同样数据填充一样可以包含)
     *      2. 发布配置文件
     * 注意命名空间最前面含有 \
     */
    private $commands = [
        \LeePrince\LaravelWechatShop\Wap\Member\Console\commands\InstallCommand::class,
    ];
    
    /**
     * [注册服务]
     *
     * @Author  leeprince:2020-07-16 22:29
     */
    public function register()
    {
        // dump('这是的 laravel-wechat-shop-wap-member 服务提供者的 register 方法');
        
        $this->registerConfigFile();
        $this->loadAuthConfig();
    
        $this->registerRouteMiddleware();
        $this->registerConfigFilePublishing();
        $this->registerCommands();
        
    }
    
    /**
     * [引导服务：该方法在所有服务提供者被注册以后才会被调用]
     *
     * @Author  leeprince:2020-03-22 19:55
     */
    public function boot()
    {
        // dump('这是的 laravel-wechat-shop-wap-member 服务提供者的 boot 方法');
    
        $this->loadRoutes();
        $this->loadViews();
        $this->loadAuthConfig();
        $this->loadMigrations();
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
        /**
        "wap" => array:1 [▼
          "member" => array:1 [▼
            "auth" => array:4 [▼
              "controller" => "LeePrince\LaravelWechatShop\Wap\Member\Http\Controllers\AuthorizationController"
              "guard" => "member"
              "guards" => array:1 [▼
                "member" => array:2 [▼
                  "driver" => "session"
                  "provider" => "member"
                ]
              ]
              "providers" => array:1 [▼
                "member" => array:2 [▼
                  "driver" => "eloquent"
                  "model" => "LeePrince\LaravelWechatShop\Wap\Member\Models\User"
                ]
              ]
            ]
          ]
        ]
         */
        $this->mergeConfigFrom(__DIR__ . "/../Config/leeprince-member.php", 'wap.member');
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
        $this->loadViewsFrom(__DIR__ . "/../Resources/views/", 'WapMemberView');
    }
    
    /**
     * [加载用户模型守卫者配置信息到 laravel 项目中以供使用]
     *
     * @Author  leeprince:2020-07-14 13:29
     */
    private function loadAuthConfig()
    {
        config(Arr::dot(config('wap.member.auth', []), 'auth.'));
        config(Arr::dot(config('wap.member.wechat', []), 'wechat.'));
    }
    
    /**
     * [执行 vendor:publish 命令发布配置文件到指令目录，即可以发布配置文件到指定目录，达到允许外部修改配置文件信息的目的]
     *      执行：php artisan vendor:publish --provider="LeePrince\LaravelWechatShop\Wap\Member\Providers\MemberServiceProvider"
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
        }
    }
    
    /**
     * [加载需要迁移的数据库文件]
     *
     * @Author  leeprince:2020-07-14 17:59
     */
    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
    }
    
    /**
     * [注册组件包的自定义 Artisan 命令。]
     *
     * @Author  leeprince:2020-03-25 02:07
     */
    private function registerCommands()
    {
        $this->commands($this->commands);
    }
}