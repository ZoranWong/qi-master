<?php

namespace App\Transformers;

use App\Models\OrderItem;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderItemTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderItem entity.
     *
     * @param OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model)
    {
        return [
            'id' => (int)$model->id,

            'product_snapshot' => $model->product,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
