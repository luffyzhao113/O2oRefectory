<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'seller_goods',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('seller_id')->comment('店铺ID');
                $table->unsignedInteger('model_id')->comment('模型ID');
                $table->unsignedInteger('category_id')->comment('分类id');
                $table->string('bar_code', 32)->comment('商品条码');
                $table->string('name', 50)->comment('商品名称');
                $table->string('image', 100)->comment('商品图片');
                $table->unsignedInteger('price')->comment('商品价格：单位分');
                $table->unsignedInteger('stock')->comment('库存');
                $table->unsignedInteger('sale')->comment('销量');
                $table->tinyInteger('status', false, true)->default(0)->comment('状态： 0:未审核 1:已审核 2:禁售');
                $table->tinyInteger('is_sale', false, true)->comment('上架状态：0:不上架 1:上架');
                $table->string('spec', 255)->default(null)->comment('商品规格:[{"名称"：["值"]}]');
                $table->string('attribute', 255)->default(null)->comment('商品属性：属性名:属性值,属性名:属性值  利用 find_in_set 进行搜索');
                $table->timestamps();
                $table->softDeletes();

                $table->index(['seller_id', 'status', 'is_sale']);
                $table->index(['status', 'is_sale', 'category_id']);
                $table->unique(['seller_id', 'bar_code']);
            }
        );

        Schema::create(
            'seller_goods_details',
            function (Blueprint $table) {
                $table->unsignedInteger('goods_id')->comment('外键：商品表');
                $table->text('content')->nullable()->comment('商品详情表');

                $table->primary('goods_id');
            }
        );

        Schema::create(
            'seller_goods_galleries',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('goods_id')->comment('外键：商品表');
                $table->string('path')->comment('地址');
                $table->string('ext')->comment('文件类型');
                $table->smallInteger('sort')->default(255)->comment('排序');
                $table->timestamps();
                $table->softDeletes();

                $table->index('goods_id');
            }
        );

        Schema::create('seller_models', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('seller_id')->comment('店铺ID');
            $table->string('name', 50)->comment('模型名称');
            $table->string('description')->nullable()->comment('模型说明');
            $table->string('specs', 255)->nullable()->comment('模型规格');
            $table->string('attributes', 1000)->nullable()->comment('模型属性');
            $table->softDeletes();
            $table->timestamps();
            $table->index('seller_id');
        });

        Schema::create(
            'seller_goods_specs',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('goods_id')->comment('商品ID');
                $table->json('specs')->comment('商品SKU规格： {"名称"："值"}');
                $table->unsignedInteger('price')->comment('商品价格：单位分');
                $table->unsignedInteger('stock')->comment('库存');

                $table->index('goods_id');
            }
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_goods');
        Schema::dropIfExists('seller_goods_details');
        Schema::dropIfExists('seller_goods_galleries');
        Schema::dropIfExists('seller_goods_specs');
        Schema::dropIfExists('seller_models');
    }
}
