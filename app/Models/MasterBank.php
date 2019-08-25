<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MasterBank
 *
 * @property int $id
 * @property string $accountOpenBank 开户行地址
 * @property string $bankAccountCode 银行账号
 * @property int $masterId 师傅ID
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Master $master
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank whereAccountOpenBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank whereBankAccountCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterBank whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MasterBank extends Model
{
    use ModelAttributesAccess;
    protected $fillable = ['account_open_bank', 'bank_account_code', 'master_id'];


    public function master()
    {
        return $this->belongsTo(Master::class);
    }
}
