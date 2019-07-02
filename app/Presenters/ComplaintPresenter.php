<?php

namespace App\Presenters;

use App\Models\Complaint;
use App\Transformers\ComplaintTransformer;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Class ComplaintPresenter.
 *
 * @package namespace App\Presenters;
 */
class ComplaintPresenter extends BasePresenter
{
    /**
     * @var Complaint $wrappedObject
     * */
    protected $wrappedObject;

    public function masterName()
    {
        return $this->wrappedObject->master->name;
    }

    public function compensationFormat()
    {
        return number_format($this->wrappedObject->compensation, 2);
    }

    public function statusDes()
    {
        return Complaint::STATUS[$this->wrappedObject->status];
    }

    public function applyAt()
    {
        return $this->wrappedObject->createdAt->format('Y-m-d H:i:s');
    }
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ComplaintTransformer();
    }
}
