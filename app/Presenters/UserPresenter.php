<?php

namespace App\Presenters;

use App\Models\User;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Class UserPresenter.
 *
 * @package namespace App\Presenters;
 */
class UserPresenter extends BasePresenter
{
    /**
     * @var User $wrappedObject
     * */
    protected $wrappedObject;
    /**
     *
     * @return string
     */
    public function userName()
    {
        return $this->wrappedObject->nickname ?? $this->wrappedObject->name;
    }

    public function avatarUrl()
    {
        return $this->wrappedObject->avatar ?? '';
    }

    public function balanceFormat()
    {
        return number_format($this->wrappedObject->balance, 2);
    }

    public function waitOfferCount()
    {
        return $this->wrappedObject->orderWaitOfferCount;
    }

    public function waitEmployeeCount()
    {
        return $this->wrappedObject->orderWaitHireCount;
    }

    public function waitPayCount()
    {
        return $this->wrappedObject->orderWaitPayCount;
    }

    public function waitCheckCount()
    {
        return $this->wrappedObject->orderWaitCheckCount;
    }

    public function waitCommentCount()
    {
        return $this->wrappedObject->orderWaitCommentCount;
    }

}
