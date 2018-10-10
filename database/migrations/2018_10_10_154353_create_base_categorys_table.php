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
            'base_categorys',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('parent_id')->comment("父id");
                $table->string('name', 50)->comment('分类名称');
                $table->smallInteger('sort')->default(255)->comment('排序');
                $table->timestamps();
            }
        );

        Schema::create(
            'base_attributes',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 20)->comment('属性名');
                $table->unsignedInteger('category_id')->comment('分类ID');

                $table->index('category_id');
            }
        );

        Schema::create(
            'base_attribute_values',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 20)->comment('属性值');
                $table->unsignedInteger('attribute_id')->comment('属性ID');

                $table->index('attribute_id');
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
        Schema::dropIfExists('base_categorys');
        Schema::dropIfExists('base_attributes');
        Schema::dropIfExists('base_attribute_values');
    }
}
