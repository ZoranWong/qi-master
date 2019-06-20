<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int)$model->id,

            'avatar' => '',
            'name' => $model->name,
            'nickname' => $model->nickname,
            'mobile' => $model->mobile,
            'email' => $model->email,
            'sex' => $model->sex,
            'sex_desc' => $model->sexDesc,
            'province' => $model->province,
            'city' => $model->city,
            'area' => $model->area,
            'address' => $model->address,
            'balance' => $model->balance,

            // 订单概况
            'orders' => [
                'wait_offer' => $model->orderWaitOfferCount,
                'wait_hire' => $model->orderWaitHireCount,
                'wait_pay' => $model->orderWaitPayCount,
                'wait_check' => $model->orderWaitCheckCount,
                'wait_comment' => $model->orderWaitCommentCount
            ],

            /* place your other model properties here */

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
