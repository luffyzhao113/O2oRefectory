<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateteSellerEntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建角色表
        Schema::create('seller_roles', function (Blueprint $table) {
            // ID
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('角色标识（用于程序）');
            $table->tinyInteger('status')->default(1)->comment('角色状态 0 关闭 1 开启');
            $table->integer('seller_id')->unsigned()->comment('所属店铺');
            $table->string('description')->nullable()->comment('角色介绍');
            $table->timestamps();
        });

        // 创建权限数据表
        Schema::create('seller_permissions', function (Blueprint $table) {
            // ID
            $table->increments('id');
            // 上级权限
            $table->integer('parent_id')->default(0)->unsigned();
            // 权限标识
            $table->string('name', 50)->unique();
            // 菜单图标
            $table->string('icon', 50)->nullable();
            // 是否菜单
            $table->tinyInteger('islink')->default(1);
            // 权限名称
            $table->string('display_name');
            // 权限说明
            $table->string('description')->nullable();
            // 权限创建修改时间
            $table->timestamps();
        });

        // 创建角色权限关联表
        Schema::create('seller_permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('seller_admins', function (Blueprint $table) {
            // 管理员ID
            $table->increments('id');
            // 是否开启
            $table->tinyInteger('status')->default(1)->comment('角色状态 0 关闭 1 开启');
            // 管理员登录邮箱
            $table->string('email', 50)->unique()->comment('管理员登录邮箱');
            // 管理员登录密码
            $table->string('password', 60)->nullable()->comment('管理员登录密码');
            // 用户角色
            $table->integer('role_id')->default(0)->unsigned()->comment('用户角色; 角色为 0 时 用户属于超级管理员');
            // 所属店铺
            $table->integer('seller_id')->unsigned()->comment('所属店铺');
            // 管理员token
            $table->rememberToken()->comment('管理员token');
            // 数据表时间
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
        Schema::drop('seller_permission_role');
        Schema::drop('seller_permissions');
        Schema::drop('seller_roles');
        Schema::drop('seller_admins');
    }
}
