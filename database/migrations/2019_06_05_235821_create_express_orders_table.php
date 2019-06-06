<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateExpressOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单ID');
            $table->boolean('is_reached')->default(false)->comment('货品是否到达');
            $table->string('company')->comment('快递公司');
            $table->string('express_order_no')->comment('快递单号');
            $table->string('pick_up_phone_no')->comment('提货电话');
            $table->unsignedTinyInteger('pack_num')->comment('包裹数');
            $table->boolean('instead_pay')->default(false)->comment('是否代付运费');
            $table->unsignedInteger('shipping_fee')->default(0)->comment('运费');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE `express_orders` COMMENT "快递单"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_orders');
    }
}
