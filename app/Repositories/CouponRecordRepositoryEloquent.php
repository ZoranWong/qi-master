<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CouponRecordRepository;
use App\Models\CouponRecord;
use App\Validators\CouponRecordValidator;

/**
 * Class CouponRecordRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CouponRecordRepositoryEloquent extends BaseRepository implements CouponRecordRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CouponRecord::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
