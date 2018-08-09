<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seller_id')->unique()->comment('店铺Id');;
            // 证明材料
            $table->string('name', 50)->comment('店铺法人');
            // 资料是否齐全
            $table->tinyInteger('status')->default(0)->comment('资料是否齐全 0 不齐 , 1 齐全');
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
        Schema::dropIfExists('seller_materials');
    }
}
