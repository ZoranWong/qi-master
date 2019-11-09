<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommissionToWithdrawOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdraw_deposit_orders', function (Blueprint $table) {
            //
            $table->unsignedInteger('commission')->default(0)->comment('提现佣金');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdraw_deposit_orders', function (Blueprint $table) {
            //
            $table->dropColumn('commission');
        });
    }
}
