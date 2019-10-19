<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
            $table->string('review')->comment('描述');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->timestamp('publish_at')->nullable()->default(null)->comment('发稿时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
            $table->dropColumn('review');
            $table->dropColumn('sort');
            $table->dropColumn('publish_at');
        });
    }
}
