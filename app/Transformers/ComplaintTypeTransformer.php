<?php

namespace App\Transformers;

use App\Models\ComplaintType;
use League\Fractal\TransformerAbstract;

/**
 * Class ComplaintTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class ComplaintTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the ComplaintType entity.
     *
     * @param ComplaintType $model
     *
     * @return array
     */
    public function transform(ComplaintType $model)
    {
        return [
            'id' => (int)$model->id,

            /* place your other model properties here */
            'name' => $model->name,
            'parent_id' => $model->parentId ?: 0,
            'children' => $model->children
        ];
    }
}
