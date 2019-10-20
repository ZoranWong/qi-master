<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCouponRecordsTable.
 */
class CreateCouponRecordsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupon_records', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->unsignedBigInteger('coupon_code_id');
            $table->string('type');
            $table->decimal('value');
            $table->unsignedInteger('total');
            $table->unsignedInteger('used')->default(0);
            $table->decimal('min_amount', 10, 2);
            $table->datetime('not_before')->nullable();
            $table->datetime('not_after')->nullable();
            $table->boolean('enabled');
            $table->unsignedBigInteger('user_id');
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
		Schema::drop('coupon_records');
	}
}
