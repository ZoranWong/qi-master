<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateMasterCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('评论用户ID');
            $table->unsignedInteger('master_id')->comment('被评论师傅ID');
            $table->unsignedInteger('order_id')->comment('订单ID');
            $table->text('content')->comment('评论内容');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `master_orders` COMMENT '师傅评论表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_comments');
    }
}
