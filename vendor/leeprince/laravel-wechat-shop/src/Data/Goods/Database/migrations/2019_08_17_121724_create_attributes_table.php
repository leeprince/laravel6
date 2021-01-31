<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
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
        Schema::create(config('database.connections.goods.prefix').'attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name", 250);
            $table->integer("category_id");
            $table->smallInteger("sort");
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
        Schema::dropIfExists(config('database.connections.goods.prefix').'attributes');
    }
}
