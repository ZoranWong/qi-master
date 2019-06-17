<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2019-06-16
 * Time: 20:49
 */

namespace App\Presenters;


use App\Models\PaymentOrder;
use McCool\LaravelAutoPresenter\BasePresenter;

class PaymentOrderPresenter extends BasePresenter
{
    /**
     * @var PaymentOrder $wrappedObject
     * */
    protected $wrappedObject;

    public function masterName()
    {
        return $this->wrappedObject->master->name;
    }

    public function serviceAmount()
    {
        return number_format($this->wrappedObject->amount, 2);
    }

    public function paidDate()
    {
        return $this->wrappedObject->paidAt->format('Y-m-d h:i:s');
    }

    public function feeType()
    {
        return PaymentOrder::ORDER_TYPE[$this->wrappedObject->type];
    }
}