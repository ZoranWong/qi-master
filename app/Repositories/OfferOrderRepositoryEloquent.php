<?php

namespace App\Repositories;

use App\Models\Master;
use App\Models\OfferOrder;
use App\Models\Order;
use App\Models\User;
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

    /**
     * 报价记录
     * 包含主动报价(服务商，用户不返回被服务商的报价)和被直接雇佣的报价
     */
    public function getList()
    {
        /** @var User|Master $member */
        $member = auth()->user();

        $paginator = $this->with(['order:id,order_no,type,service_id,classification_id', 'order.serviceType', 'order.classification'])
            ->scopeQuery(function ($query) use ($member) {
                if ($member instanceof User) {
                    $query->where('user_id', $member->id)->whereHas('order', function ($query) {
                        $query->where('type', Order::ORDER_TYPE_IMMEDIATE_HIRE);
                    });
                } else {
                    $query->where('master_id', $member->id);
                }

                return $query;
            })->paginate(request('limit', PAGE_SIZE));

        return $paginator;
    }
}
