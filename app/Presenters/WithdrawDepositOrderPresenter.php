<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/13
 * Time: 6:02 PM
 */

namespace App\Presenters;


use McCool\LaravelAutoPresenter\BasePresenter;

class WithdrawDepositOrderPresenter extends BasePresenter
{
    public function masterName()
    {
        return $this->wrappedObject->master->name;
    }
}
