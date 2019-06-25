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
            'real_name' => $model->realName,
            'avatar' => $model->avatar,
            'mobile' => $model->mobile,
            'email' => $model->email,

            // 服务省市区
            'province' => $model->province,
            'city' => $model->city,
            'area' => $model->area,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
