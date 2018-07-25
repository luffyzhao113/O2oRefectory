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
            // 管理员ID
            $table->increments('id');
            // 是否开启
            $table->tinyInteger('status')->default(1)->comment('角色状态 0 关闭 1 开启');
            // 管理员登录邮箱
            $table->string('email', 50)->unique()->comment('管理员登录邮箱');
            // 管理员登录密码
            $table->string('password', 60)->nullable()->comment('管理员登录密码');
            // 用户角色
            $table->integer('role_id')->unsigned()->comment('用户角色');
            // 管理员token
            $table->rememberToken()->comment('管理员token');
            // 数据表时间
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('base_roles')
                ->onUpdate('cascade')->onDelete('cascade');
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
