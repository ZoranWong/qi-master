<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('amount')->comment('退款金额');
            $table->unsignedInteger('order_id')->comment('订单ID');
            $table->unsignedTinyInteger('status')->comment('状态');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('master_id')->comment('师傅ID');
            $table->string('remark')->default('')->comment('备注说明');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refund_orders');
    }
}
