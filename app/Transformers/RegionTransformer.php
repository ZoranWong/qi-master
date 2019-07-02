<?php

namespace App\Transformers;

use App\Models\Region;
use League\Fractal\TransformerAbstract;

/**
 * Class RegionTransformer.
 *
 * @package namespace App\Transformers;
 */
class RegionTransformer extends TransformerAbstract
{
    /**
     * Transform the Region entity.
     *
     * @param Region $model
     *
     * @return array
     */
    public function transform(Region $model)
    {
        return [
            'region_code' => (int)$model->regionCode,

            /* place your other model properties here */
            'name' => $model->name,
            'children' => $model->children
        ];
    }
}
