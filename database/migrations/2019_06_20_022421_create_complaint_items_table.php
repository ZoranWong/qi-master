<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_items', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('complaint_id')->comment('投诉ID');

            $table->string('content')->comment('举证内容');

            $table->json('evidence')->comment('举证内容，包含图片，音视频');

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
        Schema::dropIfExists('complaint_items');
    }
}
