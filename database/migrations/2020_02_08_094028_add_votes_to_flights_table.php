<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVotesToFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flights', function (Blueprint $table) {
            //
            // $table->char('real_name', 100)->after('name');
            // $table->string('email')->nullable()->comment('这是我的邮箱');
            $table->integer('destination_id')->nullable()->comment('目的地ID');
            $table->integer('arrived_at')->nullable()->comment('航班到达时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flights', function (Blueprint $table) {
            //
        });
    }
}
