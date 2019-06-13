<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateOrderTracesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_traces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单ID');
            $table->unsignedInteger('order_item_id')->comment('订单子项ID');
            $table->unsignedInteger('offer_order_id')->comment('报价单ID');
            $table->string('status')->comment('状态');
            $table->text('log')->comment('跟踪日志');
            $table->timestamps();
        });
//        DB::statement('ALTER TABLE `order_traces` COMMENT "订单追踪记录"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_traces');
    }
}
