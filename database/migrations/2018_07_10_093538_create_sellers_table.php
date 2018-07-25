<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('商店名称');
            $table->tinyInteger('status')->default(1)->comment('商店状态 1 正常  0关闭');
            $table->tinyInteger('auditing_status')->default(0)->comment('审核状态 0 待审核 1 已审核 2 审核失败');
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
        Schema::dropIfExists('sellers');
    }
}
