<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_services', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('master_id')->comment('师傅ID');
            $table->char('region_code', 6)->comment('服务区域代码');
            $table->enum('type', ['CORE', 'KEY', 'OTHER'])->comment('服务区域类型');
            $table->unsignedTinyInteger('weight')->default(1)->comment('权重');

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
        Schema::dropIfExists('master_services');
    }
}
