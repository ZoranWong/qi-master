<?php

namespace App\Transformers;

use App\Models\FavouriteMaster;
use App\Models\Master;
use League\Fractal\TransformerAbstract;

/**
 * Class FavouriteMasterTransformer.
 *
 * @package namespace App\Transformers;
 */
class FavouriteMasterTransformer extends TransformerAbstract
{
    /**
     * Transform the FavouriteMaster entity.
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

            'cooperative_nums' => $model->ordersCount,// 合作数量
            'remark' => $model->pivot->remark,// 收藏师傅的备注

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
