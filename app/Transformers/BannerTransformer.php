<?php

namespace App\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;
use App\Models\Banner;

/**
 * Class BannerTransformer.
 *
 * @package namespace App\Transformers;
 */
class BannerTransformer extends TransformerAbstract
{
    /**
     * Transform the Banner entity.
     *
     * @param \App\Models\Banner $model
     *
     * @return array
     */
    public function transform(Banner $model)
    {
        return [
            'id'         => (int) $model->id,
            'image_url' => Storage::url($model->imageUrl),
            'link' => $model->link
        ];
    }
}
