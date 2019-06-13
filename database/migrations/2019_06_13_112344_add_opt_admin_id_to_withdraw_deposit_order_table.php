<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptAdminIdToWithdrawDepositOrderTable extends Migration
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
            $table->unsignedInteger('opt_admin_id')->default(0)->comment('操作管理员ID');
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
        });
    }
}
