<?php

namespace App\Repositories;

use App\Models\Master;
use App\Models\RefundOrder;
use App\Models\User;
use App\Validators\RefundOrderValidator;
use Dingo\Api\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

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
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getList()
    {
        $request = app(Request::class);

        $limit = $request->input('limit', PAGE_SIZE);

        /** @var User|Master $user */
        $user = auth()->user();

        $paginator = $user->refundOrders()->paginate($limit);

        return $paginator;
    }
}
