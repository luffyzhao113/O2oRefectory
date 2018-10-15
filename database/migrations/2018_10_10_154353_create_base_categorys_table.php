<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'base_categories',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('parent_id')->comment("父id");
                $table->string('name', 50)->comment('分类名称');
                $table->smallInteger('sort')->default(255)->comment('排序');
                $table->tinyInteger('level')->default(1)->comment('分类层级');
                $table->timestamps();
            }
        );

        Schema::create(
            'base_attributes',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('category_id')->comment('分类ID');
                $table->string('name', 20)->comment('属性名');
                $table->string('values', 200)->comment('属性值,数组');
                $table->timestamps();
                $table->index('category_id');
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
        Schema::dropIfExists('base_categories');
        Schema::dropIfExists('base_attributes');
    }
}
