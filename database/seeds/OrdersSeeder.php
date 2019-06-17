<?php

use App\Models\Order;
use App\Models\Master;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\OfferOrder;
use App\Models\PaymentOrder;
use Faker\Generator;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        Order::truncate();
        OrderItem::truncate();
        OfferOrder::truncate();
        PaymentOrder::truncate();
        cache()->delete(date('Ymdh'));
        $faker = app(Generator::class);
        // 创建 100 笔订单
        $orders = factory(Order::class, 10)->create();

        foreach ($orders as $order) {
            $this->orderItems($order, $faker);
        }
    }

    protected function orderItems(Order $order, Generator $faker)
    {

        $count = $faker->randomDigitNotNull % 10;
        $items = [];
        $offerOrders = [];
        for($i = 0; $i < $count; $i ++) {
            $master = Master::query()->inRandomOrder()->first();
            $product = Product::query()->inRandomOrder()->first();
            $orderItem = new OrderItem();
            $orderItem->status = $order->status;
            $orderItem->type = $order->type;
            $orderItem->masterId = $master->id;
            $orderItem->productId = $product->id;
            $orderItem->product = [
                'id' => $product->id,
                'title' => $product->title,
                'image' => $product->image,
                'service_requirements' => [

                ]
            ];
            $orderItem->installFee = $faker->randomDigitNotNull;
            $orderItem->otherFee = $faker->randomDigitNotNull;
            $orderItem = $order->items()->save($orderItem);

            $offerOrder = new OfferOrder();
            $offerOrder->masterId = $master->id;
            $offerOrder->orderItemId = $orderItem->id;
            $offerOrder->status;
            $offerOrder->userId = $order->userId;
            $offerOrder->quotePrice = $faker->randomDigitNotNull;
            $order->offerOrders()->save($offerOrder);

            $paymentOrder = new PaymentOrder();
            $paymentOrder->userId = $order->userId;
            $paymentOrder->masterId = $master->id;
            $paymentOrder->amount = $faker->randomDigitNotNull;
            $paymentOrder->status = $faker->randomElement([
                PaymentOrder::STATUS_UNPAID,
                PaymentOrder::STATUS_PAID,
                PaymentOrder::STATUS_CLOSED
            ]);
            $paymentOrder->paidAt = $faker->date('Y-m-d h:i:s');
            $paymentOrder->payType = $faker->randomElement([
                PaymentOrder::PAY_TYPE_AL,
                PaymentOrder::PAY_TYPE_WX,
                PaymentOrder::PAY_TYPE_BANK,
                PaymentOrder::PAY_TYPE_CASH
            ]);
            $order->payments()->save($paymentOrder);
        }
    }
}
