<?php

namespace App\Repositories;

use App\Models\MasterComment;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

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
                        $query->whereHas('comments', function ($query) {
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
            $offerOrder['master']['good_comment_rate'] = $offerOrder['order_nums'] ? number_format($offerOrder['good_comment_order_nums'] / $offerOrder['order_nums'], 2) : 0;
            $offerOrder['master']['good_comment_rate'] .= PERCENTAGE_MARK;
        }

        return $offerOrders;
    }
}
