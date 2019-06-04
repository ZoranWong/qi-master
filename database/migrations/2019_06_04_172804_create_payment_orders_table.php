<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('amount')->comment('支付金额');
            $table->unsignedInteger('order_id')->comment('订单ID');
            $table->unsignedTinyInteger('status')->comment('状态');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('master_id')->comment('师傅ID');
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
        Schema::dropIfExists('payment_orders');
    }
}
