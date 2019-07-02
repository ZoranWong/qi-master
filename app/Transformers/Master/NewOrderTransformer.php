<?php

namespace App\Transformers\Master;

use App\Models\Order;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

/**
 * Class NewOrderTransformer.
 *
 * @package namespace App\Transformers\Master;
 */
class NewOrderTransformer extends TransformerAbstract
{
    /**
     * Transform the NewOrder entity.
     * @param Order $model
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id' => (int)$model->id,

            /* place your other model properties here */
            'service_type' => $model->serviceType->name,
            'classification' => $model->classification->name,
            'rest_time' => Carbon::createFromTimestamp($model->createdAt->addHours(24)->timestamp - time())->format('h小时m分'),
            'customer_info' => $model->customerInfo,
        ];
    }
}
