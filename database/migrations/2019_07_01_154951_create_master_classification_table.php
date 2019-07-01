<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterClassificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_classification', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('master_id')->comment('师父ID');
            $table->unsignedInteger('classification_id')->comment('类目');
            $table->json('services')->comment('服务类型');
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
        Schema::dropIfExists('master_classification');
    }
}
