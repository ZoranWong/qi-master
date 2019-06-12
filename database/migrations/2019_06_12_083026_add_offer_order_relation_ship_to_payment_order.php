<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfferOrderRelationShipToPaymentOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_orders', function (Blueprint $table) {
            //
            $table->unsignedInteger('offer_order_id')->default(0)->comment('报价单ID');
            $table->unsignedTinyInteger('type')->default(0)->comment('0-报价费用 1-追加费用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_orders', function (Blueprint $table) {
            //
        });
    }
}
