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
}
