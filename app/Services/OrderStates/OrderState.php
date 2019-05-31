<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/5/31
 * Time: 1:53 PM
 */

namespace App\Services\OrderStates;


use App\Exceptions\OrderException;
use App\Models\Order;

abstract class OrderState implements OrderStateInterface
{
    const ORDER_WAIT = 0;
    const ORDER_PAYING = 1;
    const ORDER_PAID = 2;
    const ORDER_COMPLETED = 3;
    const ORDER_CANCEL = 4;
    const ORDER_REFUNDING = 5;
    const ORDER_REFUNDED = 6;

    /**
     * @var Order $order
     * */
    protected $order = null;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function cancel()
    {
        // TODO: Implement cancel() method.
        throw new OrderException('订单已经取消');
    }

    public function completed()
    {
        // TODO: Implement completed() method.
        throw new OrderException('订单已经结算');
    }

    public function paid()
    {
        // TODO: Implement paid() method.
        throw new OrderException('订单已完成支付');
    }

    public function refunded()
    {
        // TODO: Implement refund() method.
        throw new OrderException('订单已经退款');
    }

    public function paying()
    {
        // TODO: Implement paying() method.

        throw new OrderException('订单正在支付，请不要重复提交');
    }

    public function refunding()
    {
        // TODO: Implement refunding() method.
        throw new OrderException('订单正在退款中，请不要重复提交');
    }
}
