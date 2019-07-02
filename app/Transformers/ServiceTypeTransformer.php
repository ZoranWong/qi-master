<?php

namespace App\Transformers;

use App\Models\ServiceType;
use League\Fractal\TransformerAbstract;

/**
 * Class ServiceTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class ServiceTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the ServiceType entity.
     *
     * @param \App\Models\ServiceType $model
     *
     * @return array
     */
    public function transform(ServiceType $model)
    {
        return [
            'id' => (int)$model->id,

            /* place your other model properties here */
            'name' => $model->name,
            'description' => $model->description,
            'tips' => $model->tips
        ];
    }
}
