<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateFavouriteMastersTable.
 */
class CreateFavouriteMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('master_id')->comment('被收藏的师傅ID');
            $table->text('remark')->nullable()->comment('备注');
            $table->timestamps();
        });

        Schema::table('masters', function (Blueprint $table) {
            $table->char('province', 6)->nullable()->comment('服务省份');
            $table->char('city', 6)->nullable()->comment('服务城市');
            $table->char('area', 6)->nullable()->comment('服务区');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favourite_masters');

        Schema::table('masters', function (Blueprint $table) {
            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('area');
        });
    }
}
