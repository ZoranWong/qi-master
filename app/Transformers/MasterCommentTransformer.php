<?php

namespace App\Transformers;

use App\Models\MasterComment;
use League\Fractal\TransformerAbstract;

/**
 * Class MasterCommentTransformer.
 *
 * @package namespace App\Transformers;
 */
class MasterCommentTransformer extends TransformerAbstract
{
    /**
     * Transform the MasterComment entity.
     *
     * @param MasterComment $model
     *
     * @return array
     */
    public function transform(MasterComment $model)
    {
        $order = $model->order;

        return [
            'id' => (int)$model->id,
            'content' => (string)$model->content,
            'labels' => $model->labels,
            'rates' => $model->rates,

            'order_id' => (int)$model->order->id,
            'order_no' => $order->orderNo,
            'order_price' => $order->totalAmount,
            'service_type_id' => $order->serviceId,
            'service_type_name' => $order->serviceType->name,
            'classification_id' => $order->classificationId,
            'classification_name' => $order->classification->name,

            'master_id' => $model->masterId,
            'master_name' => $model->master->name,

            'created_at' => $model->createdAt,
            'updated_at' => $model->updatedAt
        ];
    }
}
