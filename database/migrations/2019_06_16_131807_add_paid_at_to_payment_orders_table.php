<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidAtToPaymentOrdersTable extends Migration
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
            $table->unsignedTinyInteger('pay_type')->default(0)->comment('支付类型：0-支付宝 1-微信 2-银联 3-现金');
            $table->timestamp('paid_at')->nullable()->default(null)->comment('支付时间');
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
