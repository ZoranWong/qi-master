<?php

namespace Tests\Unit;

use App\Http\Controllers\PaymentController;
use App\Models\Master;
use App\Models\Order;
use App\Models\PaymentOrder;
use App\Models\User;
use Tests\TestCase;

class WxPayNative extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $order = new PaymentOrder();
        $order->amount = 1;
        $order->payType = PaymentOrder::TYPE_QUOTE_ORDER;
        $order->masterId = Master::inRandomOrder()->first()->id;
        $order->userId = User::inRandomOrder()->first()->id;
        $order->orderId = Order::inRandomOrder()->first()->id;
        $order->status = PaymentOrder::STATUS_UNPAID;
        $order->save();
        request()['gateway'] = 'Native';
        $response = app(PaymentController::class)->wxPay($order);
        dd($response->getContent());
        $this->assertTrue(true);
    }
}
