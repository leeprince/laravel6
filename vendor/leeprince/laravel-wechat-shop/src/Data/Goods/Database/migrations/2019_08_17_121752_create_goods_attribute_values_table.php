<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeValuesTable extends Migration
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
        Schema::create(config('database.connections.goods.prefix').'goods_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("goods_id");
            $table->integer("attribute_id");
            $table->integer("attribute_value_id");
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
        Schema::dropIfExists(config('database.connection.goods.prefix').'goods_attribute_values');
    }
}
