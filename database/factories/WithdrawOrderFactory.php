<?php

use Faker\Generator as Faker;
use App\Models\WithdrawDepositOrder;
use App\Models\Master;
use Encore\Admin\Auth\Database\Administrator;
$factory->define(WithdrawDepositOrder::class, function (Faker $faker) {
    $master = Master::query()->inRandomOrder()->first();
    $admin = Administrator::query()->inRandomOrder()->first();
    return [
        //
        'apply_amount' => $faker->randomDigitNotNull,
        'master_id' => $master->id,
        'status' => $faker->randomElement([
            WithdrawDepositOrder::HANDLING,
            WithdrawDepositOrder::AGREE_WITHDRAW,
            WithdrawDepositOrder::REFUSE_WITHDRAW
        ]),
        'transfer_amount' => $faker->randomDigitNotNull,
        'comment' => $faker->text(124),
        'opt_admin_id' => $admin->id
    ];
});
