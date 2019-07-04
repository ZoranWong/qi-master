<?php

namespace App\Transformers\Master;

use App\Models\Order;
use App\Transformers\OrderItemTransformer;
use League\Fractal\TransformerAbstract;

/**
 * Class NewOrderDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class NewOrderDetailTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['product_items'];

    /**
     * Transform the NewOrderDetail entity.
     * @param Order $model
     * @return array
     */
    public function transform(Order $model)
    {
        $customerInfo = $model->customerInfo;
        $customerInfo['name'] = '***';
//        $customerInfo['phone'] = substr_replace($customerInfo['phone'], '****', 3, 4);
        $customerInfo['phone'] = hidestr($customerInfo['phone'], 3, 4);
        $customerInfo['address'] = preg_replace('/[a-zA-Z0-9]/', '*', $customerInfo['address']);

        return [
            'id' => (int)$model->id,
            'order_no' => $model->orderNo,
            'status' => $model->status,
            'status_desc' => $model->statusDesc,

            // 客户信息
            'customer_info' => $customerInfo,
            // 服务需求
            'service_requirement' => [
                'classification_name' => $model->classification->name,// 类目名称
                'service_type_name' => $model->serviceType->name,// 服务类型名称
                'expected_service_date' => (string)$model->serviceDate,// 期望服务日期
                'comment' => $model->remark// 订单备注
            ],
            // 联系人信息
            'contact_user_info' => [
                'name' => hidestr($model->contactUserName, 1),
                'phone' => hidestr($model->contactUserPhone, 3, 4)
            ],
            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt,
            'ended_at' => $model->createdAt->addHours(24)->timestamp
        ];
    }

    public function includeProductItems(Order $order)
    {
        $items = $order->items;

        return $this->collection($items, new OrderItemTransformer);
    }
}
