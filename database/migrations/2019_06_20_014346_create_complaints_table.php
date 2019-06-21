<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');

            $table->string('complaint_no')->comment('投诉编号');
            $table->unsignedInteger('order_id')->comment('订单ID');
            $table->string('order_no')->comment('订单编号');

            $table->unsignedTinyInteger('status')->comment('状态');
            $table->unsignedTinyInteger('evidence_status')->comment('举证状态');

            $table->unsignedTinyInteger('complaint_type')->comment('投诉类型');
            $table->json('complaint_info')->comment('投诉信息，包括投诉内容，图片凭证');
            $table->unsignedInteger('compensation')->default(0)->comment('赔付金额');
            $table->json('result')->comment('处理结果');

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
        Schema::dropIfExists('complaints');
    }
}
