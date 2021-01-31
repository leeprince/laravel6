<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsDescriptionsTable extends Migration
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
        Schema::create(config('database.connections.goods.prefix').'goods_descriptions', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->text("description");
            $table->primary("id");
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
        Schema::dropIfExists(config('database.connections.goods.prefix').'goods_descriptions');
    }
}
