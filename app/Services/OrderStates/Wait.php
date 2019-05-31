<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/5/31
 * Time: 2:12 PM
 */

namespace App\Services\OrderStates;



use App\Exceptions\OrderException;

class Wait extends OrderState
{
    const STATE_CODE = OrderState::ORDER_WAIT;
    public function paying()
    {
        $this->order->status = Paying::STATE_CODE;
    }

    public function cancel()
    {
        $this->order->status = Cancel::STATE_CODE;
    }

    /**
     * @throws
     * */
    public function paid()
    {
        throw new OrderException('未支付订单无法设置为已支付状态');
    }

    /**
     * @throws
     * */
    public function refunding()
    {
        throw new OrderException('未支付订单无法退款');
    }

    /**
     * @throws
     * */
    public function refunded()
    {
        throw new OrderException('未支付订单无法退款');
    }

    /**
     * @throws
     * */
    public function completed()
    {
        throw new OrderException('未支付订单不可以设置完成');
    }

}
