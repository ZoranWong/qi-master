<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Article;

/**
 * Class ArticleTransformer.
 *
 * @package namespace App\Transformers;
 */
class ArticleTransformer extends TransformerAbstract
{
    /**
     * Transform the Article entity.
     *
     * @param \App\Models\Article $model
     *
     * @return array
     */
    public function transform(Article $model)
    {
        return [
            'id'         => (int) $model->id,
            'publish_at' => $model->publishAt->format('Y-m-d'),
            'cover_image' => $model->coverUrl,
            'title' => $model->title,
            'content' => $model->content,
            'sort' => $model->sort
        ];
    }
}
