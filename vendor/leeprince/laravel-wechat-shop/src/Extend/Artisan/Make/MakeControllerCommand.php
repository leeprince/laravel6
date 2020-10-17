<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-16 23:43
 */

namespace LeePrince\LaravelWechatShop\Extend\Artisan\Make;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Symfony\Component\Console\Input\InputArgument;


class MakeControllerCommand extends ControllerMakeCommand
{
    /**
     * 优先级：从基类继承的成员会被 trait 插入的成员所覆盖。优先顺序是来自当前类的成员覆盖了 trait 的方法，而 trait 则覆盖了被继承的方法
     */
    use TraitCommand;
    
    /**
     * 控制台命令名称
     *  注意：关于命令的变量说明
     *      - 在使用 $name 变量设置控制台命令的名称(无签名)时不需要需要在 prince-make:controller 后面加上替换参数 {name}。
     *      - 在使用 $signature 变量设置控制台命令的名称和签名时需要在 prince-make:controller 后面加上替换参数 {name}，否则报错： Too many arguments, expected arguments "command".
     *      - $signature 的优先级大于 $name
     *      - 源码：Illuminate\Console\Command
     *          if (! isset($this->signature)) {
     *              $this->specifyParameters();
     *          }
     *
     * @var string
     */
    protected $name = 'prince-make:controller';
    
    // 控制台命令的描述
    protected $description = '创建 leeprince/laravel-wechat-shop composer 组件包中的控制器：php artisan prince-make:controller 子组件名(Data/Goods) 控制器名(或者是带路径的控制器名)';
    
    protected  $defaultNamespace = '\Http\Controllers';
}