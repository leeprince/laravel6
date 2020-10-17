<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-16 23:04
 */
namespace LeePrince\LaravelWechatShop\Extend\Artisan\Make;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

trait TraitCommand
{
    protected $packagePath = __DIR__."/../../..";
    
    private $rootNamespace = 'LeePrince\LaravelWechatShop';
    
    /**
     * [获取根命名空间]
     *
     * @Author  leeprince:2020-07-16 23:57
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->rootNamespace;
    }
    
    /**
     * [获取创建的路径]
     *
     * @Author  leeprince:2020-07-16 23:57
     * @param $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        
        return  $this->packagePath.'/'.str_replace('\\', '/', $name).'.php';
    }
    
    /**
     * [获取控制台命令参数]
     *
     * @Author  leeprince:2020-07-17 02:02
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['package', InputArgument::REQUIRED, 'The package of the class'],
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
    
    /**
     * 替换给定存根的名称空间 - 引入组件的基类(如：Controller)
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            [$this->getNamespace($name), $this->rootNamespace().'\\'.$this->getPackageInputNamespace().'\\', $this->userProviderModel()],
            $stub
        );
        
        return $this;
    }
    
    /**
     * [获取子组件包的名称]
     *
     * @Author  leeprince:2020-07-16 23:56
     * @return string
     */
    protected function getPackageInput()
    {
        return ltrim(trim($this->argument('package')), '/');
    }
    
    /**
     * [获取子组件包的名称 - 组件路径]
     *
     * @Author  leeprince:2020-07-16 23:56
     * @return string
     */
    protected function getPackageInputPath()
    {
        return str_replace('\\', '/', $this->getPackageInput());
    }
    
    /**
     * [获取子组件包的名称 - 组件路径]
     *
     * @Author  leeprince:2020-07-16 23:56
     * @return string
     */
    protected function getPackageInputNamespace()
    {
        return str_replace('/', '\\', $this->getPackageInput());
    }
    
    /**
     * [默认的命名空间]
     *
     * @Author  leeprince:2020-07-16 23:56
     * @param $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\'.$this->getPackageInputNamespace().$this->defaultNamespace;
    }
}
