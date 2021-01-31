<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
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
        Schema::create(config('database.connections.goods.prefix').'categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name", 250);
            $table->integer("pid");
            $table->integer("level");
            $table->tinyInteger("is_root");
            // 保存上级的地址
            $table->string("path", 90);
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
        Schema::dropIfExists(config('database.connections.goods.prefix').'categories');
    }
}
