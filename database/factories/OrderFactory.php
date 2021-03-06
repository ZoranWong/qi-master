<?php

use App\Models\Master;
use App\Models\Order;
use App\Models\Region;
use App\Models\User;
use Faker\Generator as Faker;
use App\Models\Classification;

$factory->define(Order::class, function (Faker $faker) {
    // 随机取一个用户
    $user = User::query()->find(1);
//    $master = Master::query()->inRandomOrder()->first();
    /**@var Region $region */
    $region = Region::query()->inRandomOrder()->first();
    $master = Master::find(1);
    /**@var \App\Models\MasterService $masterService*/
    $masterService = $master->serviceAreas->first();
    $orderNo = orderNo();
    $type = $faker->randomElement([
        Order::ORDER_TYPE_FIXED_PRICE,
        Order::ORDER_TYPE_QUOTE_PRICE,
        Order::ORDER_TYPE_IMMEDIATE_HIRE
    ]);

    $status = $faker->randomElement([
        Order::ORDER_WAIT_OFFER,
        Order::ORDER_WAIT_HIRE,
        Order::ORDER_EMPLOYED|Order::ORDER_WAIT_HIRE,
        Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT|Order::ORDER_EMPLOYED|Order::ORDER_WAIT_HIRE,
        Order::ORDER_PROCEEDING_APPOINTED|Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT|Order::ORDER_EMPLOYED|Order::ORDER_WAIT_HIRE,
        Order::ORDER_PROCEEDING_PRODUCT_RECEIVED| Order::ORDER_PROCEEDING_APPOINTED|Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT|Order::ORDER_EMPLOYED|Order::ORDER_WAIT_HIRE,
        Order::ORDER_PROCEEDING_SIGNED|Order::ORDER_PROCEEDING_PRODUCT_RECEIVED| Order::ORDER_PROCEEDING_APPOINTED|Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT|Order::ORDER_EMPLOYED|Order::ORDER_WAIT_HIRE,
        Order::ORDER_WAIT_CHECK|Order::ORDER_PROCEEDING_SIGNED|Order::ORDER_PROCEEDING_PRODUCT_RECEIVED|Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT| Order::ORDER_PROCEEDING_APPOINTED|Order::ORDER_EMPLOYED|Order::ORDER_WAIT_HIRE,
        Order::ORDER_CHECKED|Order::ORDER_WAIT_CHECK|Order::ORDER_PROCEEDING_SIGNED|Order::ORDER_PROCEEDING_PRODUCT_RECEIVED| Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT|Order::ORDER_PROCEEDING_APPOINTED|Order::ORDER_EMPLOYED|Order::ORDER_WAIT_HIRE,
        Order::ORDER_COMPLETED|Order::ORDER_CHECKED|Order::ORDER_WAIT_CHECK|Order::ORDER_PROCEEDING_SIGNED|Order::ORDER_PROCEEDING_PRODUCT_RECEIVED| Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT|Order::ORDER_PROCEEDING_APPOINTED|Order::ORDER_EMPLOYED|Order::ORDER_WAIT_HIRE,
    ]);
    /**@var Classification $classification*/
    $classification = Classification::inRandomOrder()->first();
    /**@var \App\Models\ServiceType $serviceType*/
    $serviceType = $classification->services()->inRandomOrder()->first();

    return [
        'user_id' => $user->id,
//        'master_id' => $master->id,
        'type' => $type,
        'status' => $status,
        'total_amount' => 0,
        'order_no' => $orderNo,
        'service_date' => $faker->date('Y-m-d H:i:s'),
        'remark' => $faker->text(124),
        'contact_user_name' => $faker->name,
        'contact_user_phone' => $faker->phoneNumber,
        'region_code' => $masterService->regionCode,//$region->regionCode,
        'customer_info' => [
            "area" => "东城区",
            "city" => "市辖区",
            "name" => $faker->name,
            "floor" => rand(1, 10),
            "phone" => $faker->phoneNumber,
            "address" => $faker->address,
            "province" => "北京市",
            "has_elevator" => $faker->boolean
        ],
        'refund_status' => 0,
        'classification_id' => $classification->id,
        'service_id' => $serviceType->id,
        'shipping_info' => [
            'company' => $faker->title(),
            'address' => $faker->address,
            'order_no' => $faker->uuid,
            'phone' => $faker->phoneNumber,
            'pack_num' => $faker->randomDigitNotNull % 10
        ],
        'created_at' => \Carbon\Carbon::now()->subHours(rand(0, 100))
    ];
});
