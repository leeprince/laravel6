<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert([
            ['category_id' => 1, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv01", "jk02": "jv02"}'],
            ['category_id' => 2, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv01", "jk02": "jv02"}'],
            ['category_id' => 3, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv01", "jk02": "jv02"}'],
            ['category_id' => 4, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv0101", "jk02": "jv02"}'],
            ['category_id' => 5, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv0101", "jk02": "jv02"}'],
            ['category_id' => 6, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv0102", "jk02": "jv02"}'],
            ['category_id' => 7, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv0102", "jk02": "jv02"}'],
            ['category_id' => 8, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv0102", "jk02": "jv02"}'],
            ['category_id' => 9, 'good_name' => Str::random(10), 'json_data' => '{"jk01": ["jv0101", "jv0102"], "jk02": "jv02"}'],
            ['category_id' => 10, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv01", "jk02": "jv02"}'],
            ['category_id' => 1, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv0101", "jk02": "jv02"}'],
            ['category_id' => 1, 'good_name' => Str::random(10), 'json_data' => '{"jk01": "jv0101", "jk02": "jv02"}']
        ]);
    }
}
