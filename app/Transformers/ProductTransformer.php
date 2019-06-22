<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

/**
 * Class ProductTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{
    /**
     * Transform the Product entity.
     *
     * @param Product $model
     *
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id' => (int)$model->id,

            'classification_id' => $model->classificationId,
            'category_id' => $model->categoryId,
            'child_category_id' => $model->childCategoryId,
            'title' => $model->title,
            'image' => $model->image,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
