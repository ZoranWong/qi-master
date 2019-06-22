<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMasterCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_comments', function (Blueprint $table) {
            $table->unsignedTinyInteger('type')->comment('综合评分类型')->after('order_id');
            $table->json('labels')->comment('标签')->after('type');
            $table->json('rates')->comment('评分 如quality,attitude,speed')->after('labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_comments', function (Blueprint $table) {
            //
        });
    }
}
