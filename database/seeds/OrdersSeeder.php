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
                $this->addProducts($order, $faker);
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

    protected function addProducts(Order $order, Generator $faker)
    {
        $count = random_int(1, 3);
        $products = [];
        for ($i = 0; $i < $count; $i ++) {
            /**@var Product $productModel*/
            $productModel = Product::inRandomOrder()->first();
            /**@var \App\Models\Category $category*/
            $category = $order->classification->topCategories()->inRandomOrder()->first();
            /**@var \App\Models\Category $childCategory*/
            $childCategory = $category->children()->inRandomOrder()->first();
            $product = [
                'id' => $productModel->id,
                'image' => $productModel->image,
                'title' => $productModel->title,
                'remark' => $faker->text(100),
                'num' => $faker->randomDigitNotNull % 10,
                'category_id' => $category->id,
                'category_name' => $category->name,
            ];
            if($childCategory){
                $product = array_merge($product, [
                    'child_category_id' => $childCategory->id,
                    'child_category_name' => $childCategory->name
                ]);
            }
            $products[] = $product;

            if($order->status & Order::ORDER_WAIT_HIRE) {
                $offerOrders = [];
                $count = random_int(3, 10);
                $employed = false;
                for ($i = 0; $i < $count; $i ++) {
                    $master = Master::inRandomOrder()->first();
                    $offerOrder = new OfferOrder();
                    $offerOrder->userId = $order->userId;
                    $offerOrder->masterId = $master->id;
                    $offerOrder->quotePrice = ($faker->randomDigitNotNull % 100 ) * 100;
                    $offerOrder->note = $faker->text();
                    if($order->status & Order::ORDER_EMPLOYED && !$employed){
                        $employed = true;
                        $offerOrder->status = OfferOrder::STATUS_HIRED;
                        $order->masterId = $offerOrder->masterId;
                    }else{
                        if($employed){
                            $offerOrder->status = OfferOrder::STATUS_REFUSED_INDIRECTLY;
                        }else{
                            $offerOrder->status = OfferOrder::STATUS_WAIT;
                        }
                    }
                    array_push($offerOrders, $offerOrder);
                }
                $order->offerOrders()->saveMany($offerOrders);
            }
        }
        $order->products = $products;
        $order->save();
    }
}
