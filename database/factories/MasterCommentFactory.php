<?php

use App\Models\MasterComment;
use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(MasterComment::class, function (Faker $faker) {
    $labelOptions = [
        '做事认真负责', '上门时间准时', '技术一般般', '做事拖沓', '干活不负责', '随意加价',
        '技术不错', '不按时上门服务', '服务态度恶劣', '顾客不满意', '安装速度快',
        '维修水平高', '做事效率高', '价格合适', '服务态度好', '顾客很满意'
    ];

    $order = Order::with(['user', 'master'])->whereHas('master')->inRandomOrder()->first();
    $type = $faker->randomElement(array_keys(MasterComment::TYPES));
    $labels = $faker->randomElements($labelOptions, 3);

    return [
        'order_id' => $order->id,
        'user_id' => $order->user->id,
        'master_id' => $order->master->id,
        'content' => $faker->sentence(10),
        'type' => $type,
        'labels' => $labels,
        'rates' => [
            'quality' => rand(1, 5),
            'attitude' => rand(1, 5),
            'speed' => rand(1, 5)
        ],
    ];
});
