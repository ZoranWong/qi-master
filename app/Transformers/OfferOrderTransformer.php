<?php

namespace App\Transformers;

use App\Models\OfferOrder;
use League\Fractal\TransformerAbstract;

/**
 * Class OfferOrderTransformer.
 *
 * @package namespace App\Transformers;
 */
class OfferOrderTransformer extends TransformerAbstract
{
    /**
     * Transform the OfferOrder entity.
     *
     * @param OfferOrder $model
     *
     * @return array
     */
    public function transform(OfferOrder $model)
    {
        $master = $model->master;

        return [
            'id' => (int)$model->id,

            'master' => [
                'id' => $master->id,
                'name' => $master->name,
                'avatar' => $master->avatar,
                'mobile' => $master->mobile,
                'monthly_cooperation_nums' => $master->monthly_cooperation_nums,// 月度合作数
                'monthly_order_nums' => $master->monthly_order_nums,// 月度订单数
                'good_comment_order_nums' => $master->good_comment_order_nums,// 好评数
                'order_nums' => $master->order_nums,// 订单总数
                'good_comment_rate' => $master->good_comment_rate,// 好评率
            ],

            'quote_price' => $model->quotePrice,

            'status' => $model->status,
            'status' => $model->statusDesc,

            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
