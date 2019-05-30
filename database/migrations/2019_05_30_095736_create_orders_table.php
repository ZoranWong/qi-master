<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id')->unique()->comment('订单ID');
            $table->integer('type')->index()->comment('订单类型');
            $table->integer('accepted_amount')->comment('接单费用');
            $table->integer('addition_amount')->comment('额外费用');
            $table->integer('total_amount')->comment('总费用');
            $table->integer('status')->comment('订单状态');
            $table->integer('contractor_user_id')->index()->comment('接单师傅用户ID');
            $table->integer('employer_user_id')->index()->comment('发单用户ID');
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
        Schema::dropIfExists('orders');
    }
}
