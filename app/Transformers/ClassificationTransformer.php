<?php

namespace App\Transformers;

use App\Models\Classification;
use League\Fractal\TransformerAbstract;

/**
 * Class ClassificationTransformer.
 *
 * @package namespace App\Transformers;
 */
class ClassificationTransformer extends TransformerAbstract
{
    /**
     * Transform the Classification entity.
     *
     * @param \App\Models\Classification $model
     *
     * @return array
     */
    public function transform(Classification $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name
        ];
    }
}
