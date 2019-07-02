<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdAndMasterIdComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('complaints', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('master_id')->comment('师傅ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('master_id');
        });
    }
}
