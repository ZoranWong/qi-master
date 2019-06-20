<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->comment('昵称')->after('name');
            $table->string('avatar')->default('')->comment('头像')->after('nickname');
            $table->unsignedTinyInteger('sex')->default(0)->comment('性别 0->保密 1->男 2->女');
            $table->char('province', 6)->nullable()->comment('省份');
            $table->char('city', 6)->nullable()->comment('城市');
            $table->char('area', 6)->nullable()->comment('区');
            $table->string('address')->default('')->comment('详细地址');
            $table->unsignedInteger('balance')->default(0)->comment('余额 单位：分');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
