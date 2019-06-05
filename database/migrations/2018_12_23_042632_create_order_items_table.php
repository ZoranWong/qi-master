<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单ID');
            $table->unsignedInteger('product_id')->comment('产品ID');
            $table->json('product')->comment('产品快照');
            $table->unsignedInteger('install_fee')->default(0)->comment('安装费用');
            $table->unsignedInteger('other_fee')->default(0)->comment('其他费用');
            $table->unsignedTinyInteger('status')->default(0)->comment('订单状态');
            $table->unsignedTinyInteger('type')->default(0)->comment('订单类型');
            $table->unsignedInteger('master_id')->default(0)->comment('雇佣师傅ID');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE `order_items` COMMENT "订单详情表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
