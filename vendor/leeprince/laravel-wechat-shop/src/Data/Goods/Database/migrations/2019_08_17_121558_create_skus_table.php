<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkusTable extends Migration
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
        Schema::create(config('database.connections.goods.prefix').'skus', function (Blueprint $table) {
            // sku 的id生成方式 - 根据与 属性值s的id和商品的id
            /*
              [1,2,3,4] 8 => 生成的规则是一个唯一的值
             */
            $table->integer('id');
            $table->integer("goods_id");
            $table->string("name", 250);
            $table->integer("num");
            $table->tinyInteger("status");
            $table->decimal("price", 19, 2);
            // 属性串
            $table->string("attrs", 250);
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
        Schema::dropIfExists(config('database.connections.goods.prefix').'skus');
    }
}
