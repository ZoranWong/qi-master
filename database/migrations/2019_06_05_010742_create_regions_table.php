<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->string('region_code', 6)->comment('行政编号');
            $table->string('parent_code', 6)->comment('上级行政区域');
            $table->string('name')->comment('行政区名称');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：0-关闭服务 1-开启服务');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("
        alter table `regions` add primary key `region_code` use btree;
        alter table `regions` add index key `parent_code` use btree;
        alter table `regions` comment '行政区域表'

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
