<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/13
 * Time: 1:12 PM
 */

namespace App\Presenters;


use App\Models\Order;
use McCool\LaravelAutoPresenter\BasePresenter;

class OrderPresenter extends BasePresenter
{
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
        return $this->wrappedObject->createdAt->format('Y-m-d h:i');
    }
    public function employer()
    {
        return $this->wrappedObject->user->name;
    }
}