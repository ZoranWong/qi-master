<?php

namespace App\Transformers;

use App\Models\RefundOrder;
use League\Fractal\TransformerAbstract;

/**
 * Class RefundOrderTransformer.
 *
 * @package namespace App\Transformers;
 */
class RefundOrderTransformer extends TransformerAbstract
{
    /**
     * Transform the RefundOrder entity.
     *
     * @param RefundOrder $model
     *
     * @return array
     */
    public function transform(RefundOrder $model)
    {
        return [
            'id' => (int)$model->id,

            'order_id' => $model->orderId,
            'order_no' => $model->order->orderNo,
            'service_type' => $model->order->serviceType->name,
            'classification' => $model->order->classification->name,

            'master_id' => $model->masterId,
            'master_name' => $model->master->name,

            'order_price' => $model->order->totalAmount,
            'refund_price' => $model->amount,
            'status' => $model->status,
            'status_desc' => $model->statusDesc,
            'apply_status' => $model->applyStatus,
            'apply_status_desc' => $model->applyStatusDesc,
            'final_status' => $model->finalStatus,

            'refund_info' => [
                'refund_mode_desc' => $model->refundModeDesc,
                'refund_method_desc' => $model->refundMethodDesc,
                'refund_amount' => $model->amount,
                'remark' => $model->remark,
                'refund_no' => $model->refundNo,
            ],

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
