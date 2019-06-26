<?php

namespace App\Repositories;

use App\Models\Master;
use App\Models\MasterComment;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Dingo\Api\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;
use Symfony\Component\Inflector\Inflector;

class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $fieldSearchable = [
        'status',
        'order_no',
        'master.name' => 'like',
        'master.mobile',
        'customer_phone',
        'customer_name' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
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
     * 获取订单报价单列表
     * @param Order $order
     * @return Collection
     */
    public function getOfferOrderList(Order $order)
    {
        $offerOrders = $order->offerOrders()->with([
            'master' => function ($query) use ($order) {
                $query->withCount([
                    // 一月合作数
                    'orders as monthly_cooperation_nums' => function ($query) use ($order) {
                        $query->where('user_id', $order->userId)->whereDate('created_at', '>=', Carbon::now()->subMonth());
                    },
                    // 一月订单数
                    'orders as monthly_order_nums' => function ($query) {
                        $query->whereDate('created_at', '>=', Carbon::now()->subMonth());
                    },
                    // 好评数
                    'orders as good_comment_order_nums' => function ($query) {
                        $query->whereHas('comment', function ($query) {
                            $query->where('type', MasterComment::TYPE_GOOD);
                        });
                    },
                    // 总订单数
                    'orders as order_nums'
                ]);
            }
        ])->get();

        foreach ($offerOrders as $offerOrder) {
            // 好评率
            $offerOrder['master']['good_comment_rate'] = $offerOrder->master->order_nums ? number_format($offerOrder->master->good_comment_order_nums / $offerOrder->master->order_nums * 100, 2) : 0;
            $offerOrder['master']['good_comment_rate'] .= PERCENTAGE_MARK;
        }

        return $offerOrders;
    }

    /**
     * 获取订单列表
     */
    public function getList()
    {
        /** @var User|Master $user */
        $user = auth()->user();

        $memberTypeId = Inflector::singularize(config('auth.defaults.guard')) . '_id';

        $request = app(Request::class);

        $limit = $request->input('limit', PAGE_SIZE);

        $queryData = $request->input();

        $paginator = $this->scopeQuery(function ($query) use ($user, $queryData, $memberTypeId) {
            return $query->where($memberTypeId, $user->id)->where(function (Builder $query) use ($queryData) {
                if (isset($queryData['status'])) {
                    $query->where('status', $queryData['status']);
                }
            });
        })->paginate($limit);

        return $paginator;
    }
}
