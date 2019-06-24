<?php

namespace App\Repositories;

use App\Models\MasterComment;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function getOfferOrderList(Order $order)
    {
        $order->offerOrders()->with([
            'master' => function (Builder $query) use ($order) {
                $query->withCount([
                    // 一月合作数
                    'orders as cooperation_nums' => function (Builder $query) use ($order) {
                        $query->where('user_id', $order->userId)->whereDate('created_at', '>=', Carbon::now()->subMonth());
                    },
                    // 一月订单数
                    'orders'
                ])
                    ->join('master_comments', function ($join) {
                        $join->on('masters.id', '=', 'master_comments.master_id')->where('type', '=', MasterComment::TYPE_GOOD);
                    })
                    ->groupBy('masters.id')
                    ->selectRaw("masters.*,count(*)");
            }
        ]);
    }
}
