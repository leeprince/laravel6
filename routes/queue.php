<?php

use App\Jobs\SendReminderEmail;

Route::get('/dispatchQueueJob', function () {
    // dump(1);
    
    // 分发任务
    /**
     * 启动队列处理器
     *    启动默认连接及队列
     *      php artisan queue:work
     *    启动指定连接及队列
     *      php artisan queue:work redis --queue=default_queue_name_01
     */
    dispatch(new SendReminderEmail()); // 默认
    // dispatch(new SendReminderEmail())->onQueue('default_queue_name_01');
    dump('分发任务成功');
});
