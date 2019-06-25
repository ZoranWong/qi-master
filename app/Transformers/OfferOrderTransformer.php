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


            'created_at' => $model->createdAt,
            'updated_at' => $model->updatedAt
        ];
    }
}
