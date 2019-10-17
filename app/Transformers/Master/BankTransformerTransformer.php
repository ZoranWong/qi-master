<?php

namespace App\Transformers\Master;

use App\Models\Master;
use League\Fractal\TransformerAbstract;
use App\Models\MasterBank;

/**
 * Class BankTransformerTransformer.
 *
 * @package namespace App\Transformers\Master;
 */
class BankTransformerTransformer extends TransformerAbstract
{
    /**
     * Transform the BankTransformer entity.
     *
     * @param \App\Models\MasterBank $model
     *
     * @return array
     */
    public function transform(MasterBank $model)
    {
        /**@var Master $master*/
        $master = auth()->user();
        return [
            'id'         => (int) $model->id,
            'account_open_bank' => $model->accountOpenBank,
            'bank_account_code' => $model->bankAccountCode,
            'balance' => $master->balance
        ];
    }
}
