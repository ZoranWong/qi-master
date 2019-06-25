<?php

namespace App\Transformers;

use App\Models\RefundOrder;
use League\Fractal\TransformerAbstract;

/**
 * Class RefundDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class RefundDetailTransformer extends TransformerAbstract
{
    /**
     * Transform the RefundDetail entity.
     *
     * @param RefundOrder $model
     *
     * @return array
     */
    public function transform(RefundOrder $model)
    {
        $order = $model->order;

        return [
            'id' => (int)$model->id,

            'order' => [
                'id' => (int)$order->id,
                'order_no' => $order->orderNo,
                'total_amount' => $order->totalAmount,
                'created_at' => (string)$order->createdAt,
            ],
            'refund_info' => [
                'refund_mode_desc' => $model->refundModeDesc,
                'refund_method_desc' => $model->refundMethodDesc,
                'refund_amount' => $model->amount,
                'remark' => $model->remark,
                'refund_no' => $model->refundNo,
            ],
            'audit_info' => $model->audit,
            'arbitration_info' => $model->arbitration,
            'has_customer' => (boolean)$model->hasCustomer,
            'final_status' => $model->finalStatus,
            'status' => $model->status,
            'status_desc' => $model->statusDesc,
            'apply_status' => $model->applyStatus,
            'apply_status_desc' => $model->applyStatusDesc,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
