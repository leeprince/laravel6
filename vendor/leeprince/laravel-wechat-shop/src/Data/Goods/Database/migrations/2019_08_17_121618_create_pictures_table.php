<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
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
        Schema::create(config('database.connections.goods.prefix').'pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("url", 250);
            $table->integer("goods_id");
            $table->tinyInteger("is_main");
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
        Schema::dropIfExists(config('database.connections.goods.prefix').'pictures');
    }
}
