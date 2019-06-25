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
            'balance' => $model->balance,

            // 服务省市区
            'province' => $model->province,
            'city' => $model->city,
            'area' => $model->area,

            // 聚合数据
            'order_nums' => $model->order_nums,
            'good_comment_order_nums' => $model->good_comment_order_nums,
            'order_wait_hired_count' => $model->order_wait_hired_count,
            'order_wait_pay_count' => $model->order_wait_pay_count,
            'order_on_proceeding_count' => $model->order_on_proceeding_count,
            'order_wait_check_count' => $model->order_wait_check_count,
            'order_wait_agree_count' => $model->order_wait_agree_count,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
