<?php

namespace App\Transformers\Master;

use App\Models\MasterComment;
use League\Fractal\TransformerAbstract;

/**
 * Class MasterCommentTransformer.
 *
 * @package namespace App\Transformers\Master;
 */
class MasterCommentTransformer extends TransformerAbstract
{
    /**
     * Transform the MasterComment entity.
     * @param MasterComment $model
     * @return array
     */
    public function transform(MasterComment $model)
    {
        return [
            'id' => (int)$model->id,

            'user_name' => $model->user->name,
            'general_rate' => $model->typeDesc,
            'rates' => $model->rates,
            'labels' => $model->labels,
            'content' => $model->content,
            'order_id' => $model->orderId,
            'service_type' => $model->order->serviceType->name,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
