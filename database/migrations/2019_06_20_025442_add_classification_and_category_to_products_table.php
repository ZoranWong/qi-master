<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassificationAndCategoryToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->unsignedInteger('classification_id')->comment('类目');
            $table->unsignedInteger('service_id')->comment('服务类型ID');
            $table->unsignedInteger('category_id')->default(0)->comment('类别ID');
            $table->unsignedInteger('child_category_id')->default(0)->comment('子类别ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
