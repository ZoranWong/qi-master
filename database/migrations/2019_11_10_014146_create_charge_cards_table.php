<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('charge_amount')->default(0)->comment('充值金额');
            $table->boolean('used')->default(true)->comment('是否使用');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_cards');
    }
}
