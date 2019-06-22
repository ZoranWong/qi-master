<?php

namespace App\Repositories;

use App\Models\MasterComment;
use App\Validators\MasterCommentValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class MasterCommentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MasterCommentRepositoryEloquent extends BaseRepository implements MasterCommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MasterComment::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
