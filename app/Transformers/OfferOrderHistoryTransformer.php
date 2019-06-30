<?php

namespace App\Transformers;

use App\Models\OfferOrder;
use League\Fractal\TransformerAbstract;

/**
 * Class OfferOrderHistoryTransformer.
 *
 * @package namespace App\Transformers;
 */
class OfferOrderHistoryTransformer extends TransformerAbstract
{
    /**
     * Transform the OfferOrderHistory entity.
     * @param OfferOrder $model
     * @return array
     */
    public function transform(OfferOrder $model)
    {
        $order = $model->order;

        return [
            'id' => (int)$model->id,

            'order' => [
                'id' => $order->id,
                'order_no' => $order->orderNo,
                'type_desc' => $order->typeDesc,
                'service_type_name' => $order->serviceType->name,
                'classification_name' => $order->classification->name
            ],

            'quote_price' => $model->quotePrice,
            'status_desc' => $model->statusDesc,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
