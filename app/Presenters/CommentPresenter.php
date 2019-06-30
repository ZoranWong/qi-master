<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/30
 * Time: 5:22 PM
 */

namespace App\Presenters;


use App\Models\MasterComment;
use McCool\LaravelAutoPresenter\BasePresenter;

class CommentPresenter extends BasePresenter
{
    /**
     * @var MasterComment $wrappedObject
     * */
    protected $wrappedObject = null;

    public function serviceQuotePrice()
    {
        return number_format($this->wrappedObject->order->totalAmount, 2);
    }

    public function serviceType()
    {
        return $this->wrappedObject->order->serviceType->name;
    }

    public function commentAt()
    {
//        dd($this->wrappedObject->createdAt->format('Y-m-d H:i'));
        return $this->wrappedObject->createdAt->format('Y-m-d H:i');
    }
}
