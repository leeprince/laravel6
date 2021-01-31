<?php

namespace LeePrince\LaravelWechatShop\Data\Goods\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class GoodsServerProvider extends ServiceProvider
{
    /**
     * 路由的配置信息
     */
    private $routeConfig = [
        // 定义访问路由的域名
        // 'domain' => config('leeprince.com', null),
        'namespace' => 'LeePrince\LaravelWechatShop\Data\Goods\Http\Controllers',
        'prefix' => 'LaravelWechatShopDataGoods',
        'middleware' => 'web'
    ];

    /**
     * [注册服务]
     *
     * @Author  leeprince:2020-07-16 22:29
     */
    public function register()
    {
        $this->registerConfigFile();

        $this->registerConfigFilePublishing();
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
        $this->loadDotConfig();
        $this->loadMigrations();
        $this->loadModelObserves();
    }

    /**
     * [注册配置文件。将给定配置与现有配置合并]
     *
     * @Author  leeprince:2020-07-14 13:07
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
        $this->mergeConfigFrom(__DIR__ . "/../Config/config.php", 'data.goods');
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
        $this->loadViewsFrom(__DIR__ . "/../Resources/views/", 'DataGoodsView');
    }

    /**
     * [用点「.」展平多维关联数组，再重新设置配置]
     *     将 mergeConfigFrom 中合并
     *
     * @Author  leeprince:2020-07-14 13:29
     */
    private function loadDotConfig()
    {
        /** 配置数据库连接 */
        // 将默认连接的配置复制到自定义连接名中, 再重新设置配置
        config(
            Arr::dot(
                config('database.connections.' . config('data.goods.database.connection.default'), []),
                'database.connections.' . config('data.goods.database.connection.customer') . '.')
        );
        // 自定义连接的配置覆盖默认连接复制过来的配置, 再重新设置配置
        config(
            Arr::dot(
                config('data.goods.database.' . config('data.goods.database.connection.customer'), []),
                'database.connections.' . config('data.goods.database.connection.customer') . '.')
        );
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
     * 绑定模型事件
     *
     */
    private function loadModelObserves()
    {
        // 定位：Illuminate\Database\Eloquent\Concerns\HasEvents::observe();
        // 所有注册的事件绑定：Illuminate\Events\Dispatcher 中的 $listeners属性
        // 查找并执行：Illuminate\Database\Eloquent\Concerns\HasEvents::fireModelEvent();
        // 批量新增的问题： 1. 修改源码【简单】； 2：引用其他插件
        Category::observe(CategoryObserver::class);
    }
}
