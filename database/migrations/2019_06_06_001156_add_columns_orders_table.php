<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('service_date')->default(null)->comment('服务时间');
            $table->text('comment')->default('')->comment('备注');
            $table->string('contact_user_name')->comment('联系人姓名');
            $table->string('contact_user_phone')->comment('联系人电话');
            $table->string('customer_name')->comment('客户名称');
            $table->string('customer_phone')->comment('客户电话');
            $table->string('region_code', 6)->comment('行政区域编号');
            $table->string('customer_address')->comment('服务地址');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
