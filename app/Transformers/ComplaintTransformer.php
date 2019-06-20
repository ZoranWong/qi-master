<?php

namespace App\Transformers;

use App\Models\Complaint;
use League\Fractal\TransformerAbstract;

/**
 * Class ComplaintTransformer.
 *
 * @package namespace App\Transformers;
 */
class ComplaintTransformer extends TransformerAbstract
{
    /**
     * Transform the Complaint entity.
     *
     * @param Complaint $model
     *
     * @return array
     */
    public function transform(Complaint $model)
    {
        return [
            'id' => (int)$model->id,

            'complaint_no' => $model->complaintNo,
            'master_id' => $model->master->id,
            'master_name' => $model->master->name,
            'order_id' => $model->orderId,
            'order_no' => $model->orderNo,
            'status' => $model->status,
            'status_desc' => $model->statusDesc,
            'evidence_status' => $model->evidenceStatus,
            'evidence_status_desc' => $model->evidenceStatusDesc,
            'compensation' => $model->compensation,// 赔付金额

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
