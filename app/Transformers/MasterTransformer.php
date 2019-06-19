<?php

namespace App\Transformers;

use App\Models\Master;
use League\Fractal\TransformerAbstract;

/**
 * Class MasterTransformer.
 *
 * @package namespace App\Transformers;
 */
class MasterTransformer extends TransformerAbstract
{
    /**
     * Transform the Master entity.
     *
     * @param Master $model
     *
     * @return array
     */
    public function transform(Master $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name,
            'mobile' => $model->mobile,
            'email' => $model->email,

            /* place your other model properties here */

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
