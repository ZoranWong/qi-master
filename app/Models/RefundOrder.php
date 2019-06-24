<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\RefundOrderPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * App\Models\RefundOrder
 *
 * @property int $id
 * @property int $amount 退款金额
 * @property int $orderId 订单ID
 * @property int $status 状态
 * @property int $userId 用户ID
 * @property int $masterId 师傅ID
 * @property string $remark 备注说明
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property int $paymentOrderId 支付单ID
 * @property string $refundNo 退款编号
 * @property int $refundMode 退款服务
 * @property int $refundMethod 退款方式
 * @property int $hasCustomer 是否客服介入
 * @property mixed $audit 服务商处理结果
 * @property mixed|null $arbitration 仲裁结果
 * @property int $applyStatus 服务商处理结果
 * @property-read mixed $applyStatusDesc
 * @property-read mixed $statusDesc
 * @property-read \App\Models\Master $master
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\PaymentOrder $paymentOrder
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RefundOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereApplyStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereArbitration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereAudit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereHasCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder wherePaymentOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereRefundMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereRefundMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RefundOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RefundOrder withoutTrashed()
 * @mixin \Eloquent
 */
class RefundOrder extends Model implements HasPresenter
{
    use SoftDeletes, ModelAttributesAccess, CurrencyUnitTrait;

    const REFUND_STATUS_WAIT = 0;
    const REFUND_STATUS_HANDLING = 1;
    const REFUND_STATUS_DONE = 2;
    const REFUND_STATUS_REFUSED = 3;

    const REFUND_STATUS = [
        self::REFUND_STATUS_WAIT => '待审核',
        self::REFUND_STATUS_HANDLING => '处理中',
        self::REFUND_STATUS_DONE => '退款成功',
        self::REFUND_STATUS_REFUSED => '拒绝退款'
    ];

    const APPLY_STATUS_WAIT = 0;
    const APPLY_STATUS_DONE = 1;
    const APPLY_STATUS_REFUSED = 2;
    const APPLY_STATUS_CLOSED = 3;
    const APPLY_STATUS = [
        self::APPLY_STATUS_WAIT => '等待审核',
        self::APPLY_STATUS_DONE => '同意退款',
        self::APPLY_STATUS_REFUSED => '拒绝退款',
        self::APPLY_STATUS_CLOSED => '退款关闭'
    ];


    protected $fillable = [
        'amount', 'order_id', 'status', 'user_id', 'master_id', 'payment_order_id', 'remark',
        'refund_no', 'refund_mode', 'refund_method', 'has_customer', 'audit', 'arbitration', 'apply_status'
    ];

    protected $dates = ['deleted_at'];

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentOrder()
    {
        return $this->belongsTo(PaymentOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getAmountAttribute()
    {
        return $this->attributes['amount'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getStatusDescAttribute()
    {
        return self::REFUND_STATUS[$this->status];
    }

    public function getApplyStatusDescAttribute()
    {
        return self::APPLY_STATUS[$this->applyStatus];
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        // TODO: Implement getPresenterClass() method.
        return RefundOrderPresenter::class;
    }
}
