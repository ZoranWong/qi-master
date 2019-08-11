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
        return [
            'id' => (int)$model->id,
            'order_no' => (string)$model->orderNo,
            'customer_info' => $model->customerInfo,
            'total_amount' => $model->totalAmount,
            'status' => $model->status,
            'status_desc' => $model->statusDesc,
            'product_snapshots' => $model->products,
            'service_type' => $model->serviceType->name,// 服务类型
            'classification' => $model->classification->name,// 类目
            'offer_orders_count' => $model->offerOrders()->count(),// 报价数
            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
