<?php

use App\Models\Master;
use App\Models\MasterComment;
use App\Models\OfferOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentOrder;
use App\Models\Product;
use App\Models\RefundOrder;
use Faker\Generator;
use Illuminate\Database\Seeder;

class   OrdersSeeder extends Seeder
{
    public function run()
    {
        Order::truncate();
        OrderItem::truncate();
        OfferOrder::truncate();
        PaymentOrder::truncate();
        RefundOrder::truncate();

        $faker = app(Generator::class);
        // 创建 100 笔订单
        $generator = $this->buildOrder(1);
        ini_set('memory_limit', '-1');
        foreach ($generator as $orders) {
            cache()->delete(date('YmdHis'));
            foreach ($orders as $order) {
                $this->orderItems($order, $faker);
            }
            sleep(6);
        }
    }

    protected function buildOrder($count, $limit = 1000)
    {
        for ($i = 0; $i < $count; $i++) {
            yield factory(Order::class, $limit)->create();
        }
    }

    protected function orderItems(Order $order, Generator $faker)
    {

        $count = $faker->randomDigitNotNull % 3 + 1;
        for ($i = 0; $i < $count; $i++) {
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
            $paymentOrder = $order->payments()->save($paymentOrder);
            $refundOrder = new RefundOrder();
            $refundOrder->amount = $faker->randomDigitNotNull;
            $refundOrder->status = $faker->randomElement([
                RefundOrder::REFUND_STATUS_WAIT,
                RefundOrder::REFUND_STATUS_HANDLING,
                RefundOrder::REFUND_STATUS_DONE,
                RefundOrder::REFUND_STATUS_REFUSED
            ]);
            $refundOrder->userId = $order->userId;
            $refundOrder->masterId = $master->id;
            $refundOrder->remark = $faker->text(64);
            $refundOrder->paymentOrderId = $paymentOrder->id;
            $refundOrder->refundMode = $faker->randomElement(array_keys(RefundOrder::REFUND_MODES));
            $refundOrder->refundMethod = $faker->randomElement(array_keys(RefundOrder::REFUND_METHODS));
            $order->refundOrders()->save($refundOrder);

            $comment = new MasterComment();
            $comment->userId = $order->userId;
            $comment->masterId = $order->masterId;
            $comment->content = $faker->text(124);
            $comment->type = $faker->randomElement([
                MasterComment::TYPE_GOOD,
                MasterComment::TYPE_NORMAL,
                MasterComment::TYPE_BAD
            ]);
            $comment->labels = [
                $faker->text(5),
                $faker->text(6),
                $faker->text(7)
            ];
            $comment->rates = [
                'quality' => $faker->randomElement([
                    1, 2, 3, 4, 5, 6
                ]),
                'attitude' => $faker->randomElement([
                    1, 2, 3, 4, 5, 6
                ]), 'speed' => $faker->randomElement([
                    1, 2, 3, 4, 5, 6
                ])
            ];

            $order->comment()->save($comment);
        }
    }
}
