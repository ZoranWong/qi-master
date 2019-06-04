<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('classification_id')->comment('类目ID');
            $table->string('name')->comment('类别名称');
            $table->unsignedInteger('parent_id')->comment('父类别ID');
            $table->unsignedTinyInteger('sort')->default(0)->comment('排序');
            $table->string('unit')->default('')->comment('产品单位');
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
        Schema::dropIfExists('categories');
    }
}
