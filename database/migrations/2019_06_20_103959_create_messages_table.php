<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('member_id')->comment('会员ID');
            $table->string('member_type')->comment('会员类型 user/master');
            $table->string('title')->comment('标题');
            $table->string('type')->comment('消息类型');
            $table->text('content')->comment('内容');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态 0->未读 1->已读');

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
        Schema::dropIfExists('messages');
    }
}
