<?php

namespace App\Transformers;

use App\Models\ComplaintItem;
use League\Fractal\TransformerAbstract;

/**
 * Class ComplaintItemTransformer.
 *
 * @package namespace App\Transformers;
 */
class ComplaintItemTransformer extends TransformerAbstract
{
    /**
     * Transform the ComplaintItem entity.
     *
     * @param ComplaintItem $model
     *
     * @return array
     */
    public function transform(ComplaintItem $model)
    {
        return [
            'id' => (int)$model->id,

            /* place your other model properties here */
            'complainant_id' => (int)$model->complainantId,
            'complainant_type' => (string)$model->complainantType,
            'complainant_type_name' => (string)$model->complaintTypeName,
            'content' => (string)$model->content,
            'evidence' => $model->evidence,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
