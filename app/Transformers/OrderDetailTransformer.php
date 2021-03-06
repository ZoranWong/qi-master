<?php

namespace App\Transformers;

use App\Models\Order;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderDetailTransformer extends TransformerAbstract
{
//    protected $defaultIncludes = ['product_items'];

    /**
     * Transform the OrderDetail entity.
     *
     * @param Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id' => (int)$model->id,
            'order_no' => $model->orderNo,
            'status' => $model->status,
            'status_desc' => $model->statusDesc,
            'user' => $model->user->toArray(),
            'service_type_name' => $model->serviceType->name,// 服务类型名称
            // 客户信息
            'customer_info' => $model->customerInfo,
            // 服务需求
            'service_requirement' => [
                'classification_name' => $model->classification->name,// 类目名称
                'service_type_name' => $model->serviceType->name,// 服务类型名称
                'expected_service_date' => (string)$model->serviceDate,// 期望服务日期
                'comment' => $model->remark// 订单备注
            ],
            'comment' => $model->comment ? $model->append('type_desc') : $model->comment,// 订单评价
            // 联系人信息
            'contact_user_info' => [
                'name' => $model->contactUserName,
                'phone' => $model->contactUserPhone
            ],
            'shipping_info' => $model->shippingInfo,
            'product_snapshots' => $model->products,
            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
