<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GoodsCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods_category')->insert([
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
            ['category_name' => Str::random(10)],
        ]);
    }
}
