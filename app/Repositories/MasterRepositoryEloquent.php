<?php

namespace App\Repositories;

use App\Models\Master;
use App\Validators\MasterValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class MasterRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MasterRepositoryEloquent extends BaseRepository implements MasterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Master::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
