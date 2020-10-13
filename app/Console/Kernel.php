<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    
        // 计划 闭包 调用
        $schedule->call(function () {
            Log::debug('计划 闭包 调用。date:'.date('Y-m-d H:i:s'));
        })->everyMinute();
        
        // 计划 命令 调用
        // 每分钟执行一次任务: 执行php artisann inspire 命令，该命令以通过下面 commands() 方法注册
        $schedule->command('inspire')
            ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // 加载所有在当前文件夹的 Commands 目录下定义的命令，不加载则命令不生效。laravel 默认加载
        $this->load(__DIR__.'/Commands');
        
        // 加载通过路由文件中定义的命令使其生效，不加载则不生效则命令不生效。laravel 默认加载
        require base_path('routes/console.php');
    }
}
