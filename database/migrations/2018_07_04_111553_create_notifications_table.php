<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type')->comment('类型');

            $table->string("notifiable_type", 100)->comment('通知关联类型');
            $table->unsignedBigInteger("notifiable_id")->comment('通知外链关联ID');

            $table->text('data')->comment('主体');
            $table->timestamp('read_at')->nullable()->comment('阅读时间');
            $table->timestamps();

            $table->index(["notifiable_type", "notifiable_id"], 'notifiable_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
