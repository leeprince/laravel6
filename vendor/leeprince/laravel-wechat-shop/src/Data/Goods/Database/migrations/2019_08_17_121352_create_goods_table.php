<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    public function __construct()
    {
        $this->connection = config('data.goods.database.connection.customer');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('database.connections.goods.prefix').'goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("short_name", 90);
            $table->string("long_name", 250);
            $table->integer("brand_id");
            $table->integer("category_id");
            $table->integer("shop_id");
            $table->tinyInteger("status");
            $table->integer("pv");
            $table->smallInteger("sale");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('database.connections.goods.prefix').'goods');
    }
}
