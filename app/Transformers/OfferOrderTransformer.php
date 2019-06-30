<?php

namespace App\Transformers;

use App\Models\OfferOrder;
use League\Fractal\TransformerAbstract;

/**
 * Class OfferOrderTransformer.
 *
 * @package namespace App\Transformers;
 */
class OfferOrderTransformer extends TransformerAbstract
{
    /**
     * Transform the OfferOrder entity.
     *
     * @param OfferOrder $model
     *
     * @return array
     */
    public function transform(OfferOrder $model)
    {
        return [
            'id' => (int)$model->id,

            'quote_price' => $model->quotePrice,
            'note' => $model->note,

            'status' => $model->status,
            'status_desc' => $model->statusDesc,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
