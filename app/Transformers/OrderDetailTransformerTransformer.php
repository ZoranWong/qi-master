<?php

namespace App\Transformers;

use App\Models\OrderDetailTransformer;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderDetailTransformerTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderDetailTransformerTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderDetailTransformer entity.
     *
     * @param \App\Models\OrderDetailTransformer $model
     *
     * @return array
     */
    public function transform(OrderDetailTransformer $model)
    {
        return [
            'id' => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
