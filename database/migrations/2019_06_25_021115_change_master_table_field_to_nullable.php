<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMasterTableFieldToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masters', function (Blueprint $table) {
            $table->string('real_name')->nullable()->change();
            $table->string('email')->nullable()->change();

            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('area');

            $table->char('province_code', 6)->nullable()->comment('省份代码');
            $table->char('city_code', 6)->nullable()->comment('城市代码');
            $table->char('area_code', 6)->nullable()->comment('区域代码');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nullable', function (Blueprint $table) {
            //
        });
    }
}
