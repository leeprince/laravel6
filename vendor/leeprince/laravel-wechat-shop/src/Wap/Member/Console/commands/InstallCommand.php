<?php

namespace LeePrince\LaravelWechatShop\Wap\Member\Console\commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-wechat-shop:install';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prince - laravel wechat shop install';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump('Prince laravel wechat shop install');
        
        // 调用数据库迁移命令
        $this->call('migrate');
        
        // 发布文件配置
        $this->call('vendor:publish', [
            "--provider" => "LeePrince\LaravelWechatShop\Wap\Member\Providers\MemberServiceProvider"
        ]);
        
    }
}
