<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('weixin_openid', 64);
            $table->string('nickname', 60)->default('');
            $table->string('image_head', 255)->default('');
            $table->string('password', 64)->default('');
            $table->timestamps(0); // 相当于可空的 created_at 和 updated_at TIMESTAMP
            $table->softDeletes('deleted_at', 0); // 相当于为软删除添加一个可空的 deleted_at 字段
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_users');
    }
}
