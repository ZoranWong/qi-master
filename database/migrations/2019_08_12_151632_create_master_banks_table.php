<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_open_bank')->comment('开户行地址');
            $table->string('bank_account_code')->comment('银行账号');
            $table->unsignedInteger('master_id')->comment('师傅ID');
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
        Schema::dropIfExists('master_banks');
    }
}
