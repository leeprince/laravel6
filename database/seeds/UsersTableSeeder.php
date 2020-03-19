<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. 编写填充类
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);
        // 2. 使用"模型工厂"在命令窗口手动加入 user 表测试数据:
        // 进入tinker命令: php artisan tinker
        // 填充快捷方法: factory(App\User::class,5)->create();
        // 3. 使用模型工厂
        factory(App\User::class, 10)->create();
    }
}
