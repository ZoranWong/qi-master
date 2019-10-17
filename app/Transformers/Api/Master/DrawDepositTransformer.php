<?php

namespace App\Transformers\Api\Master;

use App\Models\Master;
use App\Models\WithdrawDepositOrder;
use League\Fractal\TransformerAbstract;


/**
 * Class DrawDepositTransformer.
 *
 * @package namespace App\Transformers\Api\Master;
 */
class DrawDepositTransformer extends TransformerAbstract
{
    /**
     * Transform the DrawDepositTransformer entity.
     *
     * @param \App\Models\WithdrawDepositOrder $model
     *
     * @return array
     */
    public function transform(WithdrawDepositOrder $model)
    {
        /**@var Master $master*/
        $master = auth()->user();
        return [
            'id'         => (int) $model->id,
            'status'     => (int)$model->status,
            'apply_amount'     => $model->applyAmount,
            'transfer_amount' => $model->transferAmount,
            'comment' => $model->comment,
            'bank' => $master->bankAccounts->count() ? $master->bankAccounts->first() : 0,
            /* place your other model properties here */
            'created_at' => (string)$model->createdAt,
            'updated_at' => (string)$model->updatedAt
        ];
    }
}
