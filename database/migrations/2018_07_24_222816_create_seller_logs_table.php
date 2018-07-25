<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seller_id')->comment('店铺ID');
            $table->string('remark')->comment('操作说明');
            //操作用户
            $table->unsignedInteger('admin_id')->comment('操作用户id');
            $table->timestamps();
            $table->index('seller_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_logs');
    }
}
