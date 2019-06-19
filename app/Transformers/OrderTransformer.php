<?php

namespace App\Transformers;

use App\Models\Order;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    /**
     * Transform the Order entity.
     *
     * @param Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        $master = $model->master;

        return [
            'id' => (int)$model->id,
            'order_no' => (string)$model->orderNo,
            'customer' => [
                'name' => $model->customerName,
                'phone' => $model->customerPhone,
                'address' => $model->customerAddress
            ],
            'total_amount' => $model->totalAmount,
            'status' => Order::STATUS[$model->status],

            'service_type' => '',// 服务类型/类目
            'offer_orders_count' => $model->offerOrders()->count(),// 报价数

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
