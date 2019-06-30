<?php

namespace App\Repositories;

use App\Models\OfferOrder;
use App\Validators\OfferOrderValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class OfferOrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OfferOrderRepositoryEloquent extends BaseRepository implements OfferOrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OfferOrder::class;
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
