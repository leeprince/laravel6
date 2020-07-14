<?php
/**
 * [创建控制器的命令]
 *
 * @Author  leeprince:2020-03-25 02:10
 */

namespace LeePrince\WeChat\Console;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Support\Str;

class MakeWechatComposerControllerCommand extends ControllerMakeCommand
{
     // 控制台命令名称。
    protected $name = 'make:wetchatcomposercontroller';
    
    // 控制台命令的描述
    protected $description = '创建 leeprince/laravel-wechat composer 组件包中的控制器';
    
    private $rootNamespace = 'LeePrince\Wechat';
    
    /**
     * 获取该类的根名称空间。
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->rootNamespace;
    }
    
    /**
     * 获取目标类路径。
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        
        return __DIR__.'/../'.str_replace('\\', '/', $name).'.php';
    }
}