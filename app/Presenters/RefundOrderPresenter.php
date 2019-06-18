<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/18
 * Time: 1:21 PM
 */

namespace App\Presenters;


use App\Models\RefundOrder;
use McCool\LaravelAutoPresenter\BasePresenter;

class RefundOrderPresenter extends BasePresenter
{
    /**
     * @var RefundOrder
     * */
    protected $wrappedObject;

    public function masterName()
    {
        return $this->wrappedObject->master->name;
    }

    public function refundAmountFormat()
    {
        return number_format($this->wrappedObject->amount, 2);
    }

    public function applyDate()
    {
        return $this->wrappedObject->createdAt->format('Y-m-d h:i:s');
    }

    public function handleDate()
    {
        return $this->wrappedObject->updatedAt->format('Y-m-d h:i:s');
    }

    public function refundStatus()
    {
        return RefundOrder::REFUND_STATUS[$this->wrappedObject->status];
    }
}
