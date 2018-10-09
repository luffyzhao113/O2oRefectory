<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // 创建角色表
        Schema::create('base_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('角色标识（用于程序）');
            $table->tinyInteger('status')->default(1)->comment('角色状态 0 关闭 1 开启');
            $table->string('description')->nullable()->comment('角色介绍');
            $table->timestamps();
        });

        // 创建权限数据表
        Schema::create('base_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->unsigned()->comment('上级权限');
            $table->string('name', 50)->unique()->comment('权限标识');
            $table->string('icon', 50)->nullable()->comment('菜单图标');
            $table->tinyInteger('islink')->default(1)->comment('是否菜单');
            $table->string('display_name')->comment('权限名称');
            $table->string('description')->nullable()->comment('权限说明');
            $table->smallInteger('sort')->default(255)->comment('排序');
            $table->timestamps();
        });

        // 创建角色权限关联表
        Schema::create('base_permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('base_permission_role');
        Schema::drop('base_permissions');
        Schema::drop('base_roles');
    }
}
