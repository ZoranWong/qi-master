<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
            $table->string('order_no')->primary()->comment('订单编号');
            $table->unsignedInteger('user_id')->comment('订单发布用户id');
            $table->unsignedTinyInteger('refund_status')->comment('退款状态');
            $table->unsignedInteger('master_id')->default(0)->comment('雇佣师傅ID');
            $table->unsignedTinyInteger('type')->default(0)->comment('订单类型');
            $table->unsignedTinyInteger('status')->default(0)->comment('订单状态');
            $table->unsignedInteger('total_amount')->default(0)->comment('订单总金额,单位：分');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('ALTER TABLE `orders` COMMENT "订单表"');
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
