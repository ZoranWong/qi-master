<?php

namespace App\Repositories;

use App\Models\ComplaintItem;
use App\Validators\ComplaintItemValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ComplaintItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ComplaintItemRepositoryEloquent extends BaseRepository implements ComplaintItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ComplaintItem::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ComplaintItemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
