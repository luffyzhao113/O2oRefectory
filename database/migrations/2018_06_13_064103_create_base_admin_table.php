<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 50)->unique()->comment('邮箱');
            $table->string('name', 20)->comment('姓名');
            $table->string('photo', 100)->comment('头像')->nullable();
            $table->tinyInteger('status')->default(1)->comment('状态 0 关闭 1 开启');
            $table->string('password', 60)->nullable()->comment('登录密码');
            $table->integer('role_id')->unsigned()->comment('用户角色');
            $table->rememberToken()->comment('token');
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
        Schema::dropIfExists('base_admins');
    }
}
