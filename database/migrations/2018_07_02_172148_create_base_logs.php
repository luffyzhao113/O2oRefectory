<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_logs', function (Blueprint $table) {
            //
            $table->increments('id');
            //路由名称
            $table->string('route', 50)->comment('路由名称');
            //提交参数
            $table->text('params')->comment('提交参数');
            //操作用户
            $table->unsignedInteger('admin_id')->comment('操作用户');
            //状态
            $table->smallInteger('status_code')->comment('http状态');
            //时间
            $table->timestamps();
            // 索引
            $table->index('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_logs');
    }
}
