<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-17 01:53
 */

namespace LeePrince\LaravelWechatShop\Extend\Artisan\Make;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Support\Str;

class MakeModelCommand extends ModelMakeCommand
{
    use TraitCommand;

    /**
     * 控制台命令名称
     *  注意：关于命令的变量说明
     *      - 在使用 $name 变量设置控制台命令的名称(无签名)时不需要需要在 make:LaravelWechatShopClass 后面加上替换参数 {name}。
     *      - 在使用 $signature 变量设置控制台命令的名称和签名时需要在 make:LaravelWechatShopClass 后面加上替换参数 {name}，否则报错： Too many arguments, expected arguments "command".
     *      - $signature 的优先级大于 $name
     *      - 源码：Illuminate\Console\Command
     *          if (! isset($this->signature)) {
     *              $this->specifyParameters();
     *          }
     *
     * @var string
     */
    protected $name = 'prince-make:model';

    protected $description = '创建 leeprince/laravel-wechat-shop composer 组件包中的模型：php artisan prince-make:model TraitCommand类中中定义的$this->packagePath的相对路径(即组件包的名称，如：Data/Goods) 模型名(或者是带路径的模型名) [-m(为模型创建迁移文件)]';

    protected $defaultNamespace = '\models';

    /**
     * [为模型创建迁移文件]
     *
     * @Author  leeprince:2020-07-17 12:19
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('prince-make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
            '--path' => $this->getPackageInputPath()
        ]);
    }
}