<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seller_id')->comment('店铺ID');
            $table->string('name', 50)->comment('横幅名称');
            $table->string('position', 20)->comment('横幅位置');
            $table->tinyInteger('status')->comment('横幅状态');
            $table->text('banners')->comment('横幅内容');
            $table->timestamps();

            $table->unique(['seller_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_banners');
    }
}
