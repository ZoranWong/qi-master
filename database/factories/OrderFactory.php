<?php

use App\Models\Master;
use App\Models\Order;
use App\Models\Region;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    // 随机取一个用户
    $user = User::query()->inRandomOrder()->first();
    $master = Master::query()->inRandomOrder()->first();
    $region = Region::query()->inRandomOrder()->first();
    $orderNo = orderNo();
    $type = $faker->randomElement([
        Order::ORDER_TYPE_FIXED_PRICE,
        Order::ORDER_TYPE_QUOTE_PRICE
    ]);
    $status = $faker->randomElement([
        Order::ORDER_WAIT_HIRE,
        Order::ORDER_WAIT_AGREE,
        Order::ORDER_EMPLOYED,
        Order::ORDER_WAIT_CHECK,
        Order::ORDER_CHECKED,
        Order::ORDER_COMPLETED,
        Order::ORDER_CANCEL
    ]);
    return [
        'user_id' => $user->id,
        'master_id' => $master->id,
        'type' => $type,
        'status' => $status,
        'total_amount' => $faker->randomDigit,
        'order_no' => $orderNo,
        'service_date' => $faker->date(),
        'remark' => $faker->text(124),
        'contact_user_name' => $faker->name,
        'contact_user_phone' => $faker->phoneNumber,
        'customer_name' => $faker->name,
        'customer_phone' => $faker->phoneNumber,
        'region_code' => $region['region_code'],
        'customer_address' => $faker->address,
        'refund_status' => 0,

        'classification_id' => rand(1, 5),
        'service_id' => rand(1, 7),
    ];
});
