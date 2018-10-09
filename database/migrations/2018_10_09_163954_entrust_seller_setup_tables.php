<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntrustSellerSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_roles', function (Blueprint $table) {
            // ID
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('角色标识（用于程序）');
            $table->tinyInteger('status')->default(1)->comment('角色状态 0 关闭 1 开启');
            $table->integer('seller_id')->unsigned()->comment('所属店铺');
            $table->string('description')->nullable()->comment('角色介绍');
            $table->timestamps();

            $table->index('seller_id');
        });

        // 创建权限数据表
        Schema::create('seller_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->unsigned()->comment('上级权限');
            $table->string('name', 50)->unique()->comment('权限标识');
            $table->string('icon', 20)->nullable()->comment('菜单图标');
            $table->tinyInteger('islink')->default(1)->comment('是否菜单');
            $table->string('display_name')->comment('权限名称');
            $table->string('description')->nullable()->comment('权限说明');
            $table->smallInteger('sort')->default(255)->comment('排序');
            $table->timestamps();
        });

        // 创建角色权限关联表
        Schema::create('seller_permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('seller_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 50)->unique()->comment('登录邮箱');
            $table->string('name', 20)->comment('姓名');
            $table->string('photo', 100)->nullable()->comment('头像')->nullable();
            $table->string('password', 60)->comment('登录密码');
            $table->integer('role_id')->default(0)->unsigned()->comment('用户角色; 角色为 0 时 用户属于超级管理员');
            $table->integer('seller_id')->unsigned()->comment('所属店铺');
            $table->tinyInteger('status')->default(1)->comment('角色状态 0 关闭 1 开启');
            $table->rememberToken()->comment('token');
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
        Schema::drop('seller_admins');
        Schema::drop('seller_roles');
        Schema::drop('seller_permissions');
        Schema::drop('seller_permission_role');
    }
}
