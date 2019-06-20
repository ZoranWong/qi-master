<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Presenters\WithdrawDepositOrderPresenter;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * App\Models\WithdrawDepositOrder
 *
 * @property int $id
 * @property int $applyAmount 提现金额
 * @property int $transferAmount 实际转账
 * @property int $masterId 师傅ID
 * @property int $status 状态：0-待审核 1-同意 2-拒绝
 * @property string $comment 说明
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property string|null $deletedAt
 * @property int $optAdminId 操作管理员ID
 * @property-read \App\Models\Master $master
 * @property-read \Encore\Admin\Auth\Database\Administrator $operator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereApplyAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereOptAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereTransferAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawDepositOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WithdrawDepositOrder extends Model implements HasPresenter
{
    //
    use CurrencyUnitTrait;

    const HANDLING = 0;
    const AGREE_WITHDRAW = 1;
    const REFUSE_WITHDRAW = 2;

    const STATUS_DESC = [
        self::HANDLING => '处理中',
        self::AGREE_WITHDRAW => '已提现',
        self::REFUSE_WITHDRAW => '拒绝提现'
    ];

    protected $fillable = ['transfer_amount', 'apply_amount', 'master_id', 'status', 'comment'];

    public function __construct(array $attributes = [])
    {
        $this->currencyColumns = [
            'transfer_amount',
            'apply_amount'
        ];
        parent::__construct($attributes);
    }

    public function setApplyAmountAttribute($value)
    {
        $this->attributes['apply_amount'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getApplyAmountAttribute()
    {
        return $this->attributes['apply_amount'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    public function setTransferAmountAttribute($value)
    {
        $this->attributes['transfer_amount'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getTransferAmountAttribute()
    {
        return $this->attributes['transfer_amount'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function operator()
    {
        return $this->belongsTo(Administrator::class, 'opt_admin_id');
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        // TODO: Implement getPresenterClass() method.
        return WithdrawDepositOrderPresenter::class;
    }
}
