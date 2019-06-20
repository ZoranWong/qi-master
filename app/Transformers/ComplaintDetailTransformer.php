<?php

namespace App\Transformers;

use App\Models\Complaint;
use League\Fractal\TransformerAbstract;

/**
 * Class ComplaintDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class ComplaintDetailTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['evidence'];

    /**
     * Transform the ComplaintDetail entity.
     *
     * @param Complaint $model
     *
     * @return array
     */
    public function transform(Complaint $model)
    {
        $order = $model->order;

        return [
            'id' => (int)$model->id,

            'complaint_no' => $model->complaintNo,
            'order_id' => $order->id,
            'order_no' => $order->orderNo,
            'master' => [
                'id' => $order->master->id,
                'name' => $order->master->name
            ],
            'customer' => [
                'name' => $order->customerName,
                'phone' => $order->customerPhone,
            ],
            'complaint_info' => $model->complaintInfo,
            'complaint_type' => $model->complaintType,

            'status' => $model->status,
            'status_desc' => $model->statusDesc,
            'evidence_status' => $model->evidenceStatus,
            'evidence_status_desc' => $model->evidenceStatusDesc,
            'compensation' => $model->compensation,// 赔付金额
            'result' => $model->result,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }

    public function includeEvidence(Complaint $complaint)
    {
        $evidenceItems = $complaint->items;

        return $this->collection($evidenceItems, new ComplaintItemTransformer);
    }
}
