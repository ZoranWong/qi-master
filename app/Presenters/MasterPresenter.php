<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/7/1
 * Time: 4:20 PM
 */

namespace App\Presenters;


use App\Models\Master;
use McCool\LaravelAutoPresenter\BasePresenter;

class MasterPresenter extends BasePresenter
{
    /**
     * @var Master $wrappedObject
     * */
    protected $wrappedObject;
    public function serviceOrderCount()
    {
        return $this->wrappedObject->orderCompleted()->count()
            + $this->wrappedObject->orderWaitCheck()->count()
            + $this->wrappedObject->orderWaitHired()->count();
    }

    public function service()
    {
        $serviceStr = '';
        foreach ($this->wrappedObject->services as $service) {
            $serviceStr .= "<p>{$service}</p>";
        }
        return $serviceStr;
    }
}
