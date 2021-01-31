<?php

namespace LeePrince\LaravelWechatShop\Extend\Artisan\Make;

use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeSeederCommand extends SeederMakeCommand
{
    use TraitCommand;

    protected $name = 'prince-make:seeder';

    protected $description = '创建 leeprince/laravel-wechat-shop composer 组件包中的模型观察者：php artisan prince-make:seeder TraitCommand类中中定义的$this->packagePath的相对路径(即组件包的名称，如：Data/Goods) 迁移名(或者是带路径的迁移名)';

    protected function getPath($name)
    {
        return $this->packagePath . '/' . $this->getPackageInput() . '/Database/seeds/' . $name . '.php';
    }
}
