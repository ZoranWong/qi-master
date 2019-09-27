<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetOrderItemIdToNullableFromOfferOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_orders', function (Blueprint $table) {
            $table->unsignedInteger('order_item_id')->nullable()->change();
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
            $table->unsignedInteger('order_item_id')->nullable(false)->change();
        });
    }
}
