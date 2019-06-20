<?php

namespace App\Transformers;

use App\Models\Message;
use League\Fractal\TransformerAbstract;

/**
 * Class MessageTransformer.
 *
 * @package namespace App\Transformers;
 */
class MessageTransformer extends TransformerAbstract
{
    /**
     * Transform the Message entity.
     *
     * @param Message $model
     *
     * @return array
     */
    public function transform(Message $model)
    {
        return [
            'id' => (int)$model->id,

            'title' => $model->title,
            'content' => $model->content,
            'status' => $model->status,

            'created_at' => $model->createdAt,
            'updated_at' => $model->updatedAt
        ];
    }
}
