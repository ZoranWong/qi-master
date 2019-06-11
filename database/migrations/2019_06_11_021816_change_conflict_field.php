<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeConflictField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_properties', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->json('property')->comment('属性值');
        });

        Schema::table('service_requirements', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->json('requirement')->comment('服务要求');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
