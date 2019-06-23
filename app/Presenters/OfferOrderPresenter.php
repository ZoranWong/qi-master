<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2019-06-16
 * Time: 19:01
 */

namespace App\Presenters;


use App\Models\OfferOrder;
use McCool\LaravelAutoPresenter\BasePresenter;

class OfferOrderPresenter extends BasePresenter
{
    /**
     * @var OfferOrder $wrappedObject
     * */
    protected $wrappedObject;

    public function orderNo()
    {
        return $this->wrappedObject->order->orderNo;
    }

    public function masterName()
    {
        return $this->wrappedObject->master->name;
    }

    public function employer()
    {
        return $this->wrappedObject->user->name;
    }

    public function quotePriceFormat()
    {
        return number_format($this->wrappedObject->quotePrice, 2);
    }

    public function serviceContent()
    {
        return $this->wrappedObject->orderItem->product['title'];
    }

    public function applyDate()
    {
        return $this->wrappedObject->createdAt->format('Y-m-d');
    }

    public function offerOrderStatus()
    {
        return OfferOrder::STATUS[$this->wrappedObject->status];
    }
}
