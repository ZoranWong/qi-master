<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/5/31
 * Time: 2:05 PM
 */

namespace App\Services\OrderStates;


use App\Exceptions\OrderException;

class Paying extends OrderState
{
    const STATE_CODE = OrderState::ORDER_PAYING;
    public function paying()
    {
        throw new OrderException('此订单正处于支付中，无法重复支付！');
    }

    public function cancel()
    {
        throw new OrderException('此订单正处于支付中，无法取消！');
    }

    public function paid()
    {
        $this->order->status = Paid::STATE_CODE;
    }
}
