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
            $table->unsignedInteger('classification_id')->comment('服务类目');
            $table->json('service_type_ids')->comment('服务类型');
            $table->char('core_area', 6)->comment('核心服务区域，由所在地址决定');
            $table->json('key_areas')->comment('重点服务区域，最多两个');
            $table->json('other_areas')->comment('其余服务区域，最多3个');
            $table->json('work_days')->comment('工作日');
            $table->unsignedInteger('team_nums')->default(1)->comment('团队人数');
            $table->unsignedInteger('truck_nums')->default(0)->comment('货车数量');
            $table->unsignedInteger('truck_type')->default(0)->comment('货车类型 1->小型 2->中型 3->大型');
            $table->double('truck_tonnage', 8, 2)->default(0)->comment('货车吨位 单位：吨');
            $table->text('self_rate')->comment('自我评价、备注');

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
