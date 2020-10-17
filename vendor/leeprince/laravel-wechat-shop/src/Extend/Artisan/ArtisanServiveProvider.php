<?php

namespace LeePrince\LaravelWechatShop\Extend\Artisan;

use Illuminate\Support\ServiceProvider;

class ArtisanServiveProvider extends ServiceProvider
{
    /*
     * 自定义 Artisan 命令，包含以下功能
     *      1. 执行数据库迁移功能：php artisan migrate(同样数据填充一样可以包含)
     *      2. 发布配置文件
     * 注意命名空间最前面含有 \
     */
    private $commands = [
        \LeePrince\LaravelWechatShop\Extend\Artisan\Make\MakeClassCommand::class,
        \LeePrince\LaravelWechatShop\Extend\Artisan\Make\MakeControllerCommand::class,
        \LeePrince\LaravelWechatShop\Extend\Artisan\Make\MakeModelCommand::class,
        \LeePrince\LaravelWechatShop\Extend\Artisan\Make\MakeMigrationCommand::class,
    ];
    
    public function register()
    {
        $this->registerCommands();
    }

    public function boot()
    {
    
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
