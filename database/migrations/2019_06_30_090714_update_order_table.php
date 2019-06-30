<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->json('customer_info')->comment('客户信息')->after('contact_user_phone');

            $table->dropColumn('customer_name');
            $table->dropColumn('customer_phone');
            $table->dropColumn('customer_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('customer_info');
            $table->string('customer_name')->comment('客户姓名');
            $table->string('customer_phone')->comment('客户联系方式');
            $table->string('customer_address')->comment('客户详细地址');
        });
    }
}
