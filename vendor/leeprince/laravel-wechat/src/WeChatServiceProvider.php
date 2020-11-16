<?php
/**
 * [服务提供者为 laravel 提供该组件的所有服务]
 *
 * @Author  leeprince:2020-03-22 19:05
 */

namespace LeePrince\WeChat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class WeChatServiceProvider extends ServiceProvider
{
    // 中间件组
    private $middlewareGroups = [];
    
    // 路由中间件
    private $routeMiddleware = [
        'wechat.subscription.CheckSignture' => \LeePrince\WeChat\Http\Middleware\CheckSignture::class,
    ];
    
    /**
     * 自定义 Artisan 命令
     *      创建控制器到组件中
     */
    private $commands = [
        Console\MakeWechatComposerControllerCommand::class
    ];
    
    /**
     * [注册服务：register 方法中，你只需要将服务绑定到服务容器中。而不要尝试在 register 方法中注册任何监听器，路由，或者其他任何功能。否则，你可能会意外地使用到尚未加载的服务提供者提供的服务。]
     *
     * @Author  leeprince:2020-03-22 19:56
     */
    public function register()
    {
        $this->registerConfigFile();
        
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
        $this->loadRoutes();
        
        $this->syncMiddlewareToRouter();
        
        $this->loadViews();
    }
    
    /**
     * [加载路由]
     *
     * @Author  leeprince:2020-03-23 00:28
     */
    private function loadRoutes()
    {
        Route::group(['namespace' => 'LeePrince\WeChat\Http\Controllers', 'prefix' => 'wechat'], function() {
            $this->loadRoutesFrom(__DIR__.'/Route/route.php');
        });
    }
    
    /**
     * 将中间件的当前状态同步到路由器
     *
     * @return void
     */
    private function syncMiddlewareToRouter()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            Route::middlewareGroup($key, $middleware);
            // $this->router->middlewareGroup($key, $middleware);
        }
        
        foreach ($this->routeMiddleware as $key => $middleware) {
            Route::aliasMiddleware($key, $middleware);
        }
    }
    
    /**
     * [加载视图]
     *
     * @Author  leeprince:2020-03-24 01:08
     */
    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__."/Resources/views/", 'wechatview');
    }
    
    /**
     * [注册配置文件。将给定配置与现有配置合并]
     *
     * @Author  leeprince:2020-03-25 00:43
     */
    private function registerConfigFile()
    {
        /**
         * 指定的 key = 配置的文件名。即可让配置文件合并到由 $this->publishes([__DIR__ . '/Config' => config_path()], $groups = null); 分配的由文件名组成的同一个组中；指定的 key != 配置的文件名时可以通过该键获取配置文件信息。
         */
        /**
         * 即读取配置文件的方式有：
         *     1. 使用$this->publishes([__DIR__ . '/Config' => config_path()], $groups = null);发布配置后，通过 {文件名.配置项} 的方式
         *     2. 通过 {mergeConfigFrom后key != 文件名的键.配置项} 的方式
         *     3. 通过{Arr::dot()合并后的键.配置项}读取
         *      注意：因为发布文件之后，外部文件配置可能会修改，以下第1和第2种方式都不能读取到新的修改。所以允许修改的部分就通过第1中去读取，不允许修改的部分使用第1和第2种都行
         */
        $this->mergeConfigFrom(__DIR__ . "/Config/leeprince-wechat.php", 'leeprince-wechat');
    }
    
    /**
     * [执行 vendor:publish 命令发布配置文件到指令目录，即可以发布配置文件到指定目录，达到允许外部修改配置文件信息的目的]
     *      执行：php artisan vendor:publish --provider="LeePrince\WeChat\WeChatServiceProvider"
     *      注意：发布的文件如果存在则不覆盖，如需继续发布，请先删除项目中./config 下同名的配置文件
     *
     * @Author  leeprince:2020-03-25 00:43
     */
    private function registerConfigFilePublishing()
    {
        // 确定应用程序是否正在控制台中运行。
        if ($this->app->runningInConsole()) {
            // 注册要由 publish 命令发布的路径，可以发布配置文件到指定目录
            $this->publishes([__DIR__ . '/Config' => config_path()], null);
        }
    }
    
    /**
     * [注册软件包的自定义 Artisan 命令。]
     *
     * @Author  leeprince:2020-03-25 02:07
     */
    private function registerCommands()
    {
        $this->commands($this->commands);
    }
}