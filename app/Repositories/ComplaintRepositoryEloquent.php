<?php

namespace App\Repositories;

use App\Models\Complaint;
use App\Validators\ComplaintValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ComplaintRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ComplaintRepositoryEloquent extends BaseRepository implements ComplaintRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Complaint::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ComplaintValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
