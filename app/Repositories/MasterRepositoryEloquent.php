<?php

namespace App\Repositories;

use App\Models\Master;
use App\Models\MasterComment;
use App\Validators\MasterValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

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
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 获取用户详细信息
     */
    public function getMasterInfo()
    {
        /** @var Master $master */
        $master = $this->with(['province:region_code,name', 'city:region_code,name', 'area:region_code,name'])
            ->withCount([
                // 服务次数
                'orders as order_nums',
                // 好评订单数
                'orders as good_comment_order_nums' => function ($query) {
                    $query->whereHas('comments', function ($query) {
                        $query->where('type', MasterComment::TYPE_GOOD);
                    });
                },
                // 报价待雇佣单，待托管|支付单，进行中订单，等待验收单，待师傅同意接单的订单
                'orderWaitHired', 'orderWaitPay', 'orderOnProceeding', 'orderWaitCheck', 'orderWaitAgree'
            ])->find(auth()->id());

        return $master;
    }

}
