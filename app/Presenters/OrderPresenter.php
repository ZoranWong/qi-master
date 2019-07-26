<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/13
 * Time: 1:12 PM
 */

namespace App\Presenters;


use App\Models\OfferOrder;
use App\Models\Order;
use McCool\LaravelAutoPresenter\BasePresenter;

class OrderPresenter extends BasePresenter
{
    /**@var Order $wrappedObject**/
    protected $wrappedObject;
    public function orderStatus()
    {
        return Order::ORDER_STATUS[$this->wrappedObject->status];
    }

    public function orderType()
    {
        return Order::ORDER_TYPE[$this->wrappedObject->type];
    }

    public function publishedAt()
    {
        return $this->wrappedObject->createdAt->format('Y-m-d h:i:s');
    }

    public function hopeServiceAt()
    {
        return $this->wrappedObject->serviceDate->format('Y-m-d h:i:s');
    }


    public function employer()
    {
        return $this->wrappedObject->user;
    }

    public function offerCount()
    {
        return $this->wrappedObject->offerOrders->count();
    }

    public function minOfferPrice()
    {
        return number_format($this->wrappedObject->offerOrders->min(function (OfferOrderPresenter $order) {
            return $order->quotePrice;
        }), 2);
    }

    public function statusClass()
    {
        switch ($this->wrappedObject->status) {
            case Order::ORDER_WAIT_OFFER: {
                return 'wait-offer color-ff5000';
            }
            default: {
                return 'color-22aac8';
            }
        }
    }

    public function customerName()
    {
        return $this->wrappedObject->customerInfo['name'];
    }
}
