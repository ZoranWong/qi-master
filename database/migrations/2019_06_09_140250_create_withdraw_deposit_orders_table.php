<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawDepositOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_deposit_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('apply_amount')->comment('提现金额');
            $table->unsignedInteger('transfer_amount')->comment('实际转账');
            $table->unsignedInteger('master_id')->comment('师傅ID');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态：0-待审核 1-同意 2-拒绝');
            $table->text('comment')->comment('说明');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw_deposit_orders');
    }
}
