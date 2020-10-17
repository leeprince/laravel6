<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-17 11:47
 */

namespace LeePrince\LaravelWechatShop\Extend\Artisan\Make;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;

class MakeMigrationCommand extends MigrateMakeCommand
{
    use TraitCommand;
    
    protected $signature = 'prince-make:migration {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';
    
    protected $description = '创建 leeprince/laravel-wechat-shop composer 组件包中的数据库迁移文件：php artisan prince-make:migration 迁移表名 --path=php artisan prince-make:migration t1 --path=Data/Goods';
    
    // 对应的源码地址是在 Illuminate\Database\Console\Migrations\MigrateMakeCommand::getMigrationPath()
    protected function getMigrationPath()
    {
        return $this->packagePath.'/'.$this->input->getOption('path').'/Database/'.'migrations';
    }
}
