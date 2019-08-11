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

    public function serviceWithMeOrderCount()
    {
        return $this->wrappedObject->orderCompleted()->where('user_id', auth()->user()->id)->count()
            + $this->wrappedObject->orderWaitCheck()->where('user_id', auth()->user()->id)->count()
            + $this->wrappedObject->orderWaitHired()->where('user_id', auth()->user()->id)->count();
    }

    public function service()
    {
        $serviceStr = '';
        foreach ($this->wrappedObject->services as $service) {
            $serviceStr .= "<p>{$service}</p>";
        }
        return $serviceStr;
    }

    public function serviceByGep()
    {
        $serviceStr = '';
        foreach ($this->wrappedObject->services as $service) {
            $serviceStr .= "{$service}/";
        }
        return trim($serviceStr, "/");
    }

    public function serviceArea()
    {
        $serviceStr = '';
        foreach ($this->wrappedObject->serviceAreas as $serviceArea) {
            $serviceStr .= "<b>{$serviceArea->region->name}</b>";
        }
        return trim($serviceStr, "/");
    }

    public function goodCommentRate()
    {
        return "0%";
    }

    public function masterName()
    {
        return $this->wrappedObject->realName ?? $this->wrappedObject->name;
    }
}
