<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masters', function (Blueprint $table) {
            $table->string('wallet_password')->nullable()->comment('钱包密码');
            $table->unsignedTinyInteger('sex')->default(0)->comment('性别 0->保密 1->男 2->女');
            $table->char('emergency_mobile', 11)->nullable()->comment('紧急联系号码');
            $table->string('address')->nullable()->comment('详细地址');
            $table->json('work_day')->comment('工作日');
            $table->json('work_time')->comment('工作时间段');
            $table->unsignedInteger('team_nums')->default(1)->comment('团队人数');
            $table->unsignedInteger('truck_nums')->default(0)->comment('货车数量');
            $table->enum('truck_type', ['CORE', 'KEY', 'OTHER'])->comment('货车数量');
            $table->double('truck_tonnage', 8, 2)->default(0)->comment('货车吨位');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masters', function (Blueprint $table) {
            $table->dropColumn('wallet_password');
            $table->dropColumn('sex');
            $table->dropColumn('emergency_mobile');
            $table->dropColumn('address');
        });
    }
}
