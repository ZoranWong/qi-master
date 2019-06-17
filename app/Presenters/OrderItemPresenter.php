<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2019-06-15
 * Time: 18:30
 */

namespace App\Presenters;


use App\Models\Order;
use App\Models\OrderItem;
use McCool\LaravelAutoPresenter\BasePresenter;

class OrderItemPresenter extends BasePresenter
{
    /**
     * @var OrderItem $wrappedObject
     * */
    protected $wrappedObject;

    public function employedMasterName()
    {
        return $this->wrappedObject->master->name;
    }

    public function orderItemStatus()
    {
        return Order::ORDER_STATUS[$this->wrappedObject->status];
    }

    public function installFeeFormat()
    {
        return number_format($this->wrappedObject->installFee, 2);
    }

    public function otherFeeFormat()
    {
        return number_format($this->wrappedObject->otherFee, 2);
    }
}