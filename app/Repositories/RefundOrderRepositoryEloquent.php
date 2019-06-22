<?php

namespace App\Repositories;

use App\Models\RefundOrder;
use App\Validators\RefundOrderValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RefundOrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RefundOrderRepositoryEloquent extends BaseRepository implements RefundOrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RefundOrder::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
