<?php

namespace App\Transformers;

use App\Models\RefundOrder;
use League\Fractal\TransformerAbstract;

/**
 * Class RefundOrderTransformer.
 *
 * @package namespace App\Transformers;
 */
class RefundOrderTransformer extends TransformerAbstract
{
    /**
     * Transform the RefundOrder entity.
     *
     * @param \App\Models\RefundOrder $model
     *
     * @return array
     */
    public function transform(RefundOrder $model)
    {
        return [
            'id' => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
