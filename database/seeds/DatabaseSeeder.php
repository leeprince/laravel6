<?php

use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * db:seed 命令将运行 DatabaseSeeder 类，这个类可以用来调用其它 Seed 类。不过，你也可以使用 --class 选项来指定一个特定的 seeder 类：
         * php artisan db:seed
         * php artisan db:seed --class=UsersTableSeeder
         * php artisan migrate --seed
         */
        $this->call(UsersTableSeeder::class);

        $this->call(GoodsTableSeeder::class);
        $this->call(GoodsCategoryTableSeeder::class);

        $this->call(FlightsTableSeeder::class);
        $this->call(DestinationTableSeeder::class);

        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
    }
}
