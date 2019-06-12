<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderItemRelationShipToOfferOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_orders', function (Blueprint $table) {
            //
            $table->unsignedInteger('order_item_id')->default(0)->comment('子订单ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_orders', function (Blueprint $table) {
            //
        });
    }
}
