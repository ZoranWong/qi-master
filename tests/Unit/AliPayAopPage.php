<?php

namespace Tests\Unit;

use App\Http\Controllers\PaymentController;
use App\Models\Master;
use App\Models\Order;
use App\Models\PaymentOrder;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AliPayAopPage extends TestCase
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
        request()['gateway'] = 'AopPage';
        $response = app(PaymentController::class)->aliPay($order);
        dd($response->getContent());
        $this->assertTrue(true);
    }
}
