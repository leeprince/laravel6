<?php

namespace LeePrince\LaravelWechatShop\Extend\Artisan\Make;

use Illuminate\Foundation\Console\ObserverMakeCommand;
use Illuminate\Support\Str;

class MakeObserverCommand extends ObserverMakeCommand
{
    use TraitCommand;

    protected $name = 'prince-make:observer';

    protected $description = '创建 leeprince/laravel-wechat-shop composer 组件包中的模型观察者：php artisan prince-make:observer TraitCommand类中中定义的$this->packagePath的相对路径(即组件包的名称，如：Data/Goods) 观察者类名(或者是带路径的观察者类名)';

    protected $defaultNamespace = "\Observers";

    protected function replaceModel($stub, $model)
    {
        $model = str_replace('/', '\\', $model);

        $namespaceModel = $this->rootNamespace() . '\\' . $this->getPackageInput() . '\\' . 'Models\\' . $model;

        if (Str::startsWith($model, '\\')) {
            $stub = str_replace('NamespacedDummyModel', trim($model, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyModel', $namespaceModel, $stub);
        }

        $stub = str_replace(
            "use {$namespaceModel};\nuse {$namespaceModel};", "use {$namespaceModel};", $stub
        );

        $model = class_basename(trim($model, '\\'));

        $stub = str_replace('DocDummyModel', Str::snake($model, ' '), $stub);

        $stub = str_replace('DummyModel', $model, $stub);

        return str_replace('dummyModel', Str::camel($model), $stub);
    }

}