<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToRefundOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refund_orders', function (Blueprint $table) {
            $table->string('refund_no')->comment('退款编号');
            $table->string('refund_mode')->default('')->comment('退款服务');
            $table->string('refund_method')->default('')->comment('退款方式');
            $table->unsignedTinyInteger('has_customer')->default(0)->comment('是否客服介入');
            $table->json('audit')->nullable()->comment('服务商处理结果');
            $table->json('arbitration')->nullable()->comment('仲裁结果');
            $table->unsignedTinyInteger('apply_status')->default(0)->comment('申请状态');
            $table->unsignedTinyInteger('arbitration_status')->default(0)->comment('客服处理状态');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refund_orders', function (Blueprint $table) {
            $table->dropColumn('refund_no');
            $table->dropColumn('refund_mode');
            $table->dropColumn('refund_method');
            $table->dropColumn('has_customer');
            $table->dropColumn('audit');
            $table->dropColumn('arbitration');
            $table->dropColumn('apply_status');
            $table->dropColumn('arbitration_status');
        });
    }
}
