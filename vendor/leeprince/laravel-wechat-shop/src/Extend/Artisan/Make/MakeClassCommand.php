<?php

namespace LeePrince\LaravelWechatShop\Extend\Artisan\Make;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

/**
 * [在组件中生成类]
 *  命令为：
 *      php artisan make:wechatshopclass className
 *      多级目录下的类：
 *      php artisan make:wechatshopclass dir1/className
 *
 * @Author  leeprince:2020-07-16 23:30
 * @package LeePrince\LaravelWechatShop\Extend\Artisan\Make
 */
class MakeClassCommand extends GeneratorCommand
{
    use TraitCommand;
    
    /**
     * 控制台命令名称
     *  注意：关于命令的变量说明
     *      - 在使用 $name 变量设置控制台命令的名称(无签名)时不需要需要在 prince-make:class 后面加上替换参数 {name}。
     *      - 在使用 $signature 变量设置控制台命令的名称和签名时需要在 prince-make:class 后面加上替换参数 {name}，否则报错： Too many arguments, expected arguments "command".
     *      - $signature 的优先级大于 $name
     *      - 源码：Illuminate\Console\Command
     *          if (! isset($this->signature)) {
     *              $this->specifyParameters();
     *          }
     *
     * @var string
     */
    // protected $name = 'prince-make:class';
    protected $signature = 'prince-make:class {name}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建 leeprince/laravel-wechat-shop composer 组件包中的类：php artisan prince-make:class className # TraitCommand类中中定义的$this->packagePath的相对路径(即组件包的名称，如：Data/Goods)可为多级目录。实例：php artisan prince-make:class dir1/className';
    
    /**
     * [获取要生成的存根文件]
     *
     * @Author  leeprince:2020-07-16 22:37
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . "/stubs/class.stub";
    }
}
