<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id')->comment('服务关系ID');
            $table->unsignedInteger('category_id')->comment('类别ID');
            $table->string('name')->comment('要求名称');
            $table->json('value')->comment('要求');
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
        Schema::dropIfExists('service_requirements');
    }
}
