<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\PaymentOrderPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * App\Models\PaymentOrder
 *
 * @property int $id
 * @property int $amount 支付金额
 * @property int $orderId 订单ID
 * @property int $status 状态,记录订单当前状态
 * @property int $userId 用户ID
 * @property int $masterId 师傅ID
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property int $offerOrderId 报价单ID
 * @property int $type 0-报价费用 1-追加费用
 * @property int $payType 支付类型：0-支付宝 1-微信 2-银联 3-现金
 * @property \Illuminate\Support\Carbon|null $paidAt 支付时间
 * @property string $code 编号
 * @property-read mixed $statusDesc
 * @property-read \App\Models\Master $master
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereOfferOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentOrder withoutTrashed()
 * @mixin \Eloquent
 */
class PaymentOrder extends Model implements HasPresenter
{
    use SoftDeletes, ModelAttributesAccess, CurrencyUnitTrait;

    protected $fillable = ['amount', 'code', 'order_id', 'status', 'user_id', 'master_id', 'offer_order_id', 'type', 'pay_type', 'paid_at'];

    protected $dates = ['deleted_at', 'paid_at'];

    const STATUS_UNPAID = 1;
    const STATUS_PAID = 2;
    const STATUS_CLOSED = 3;
    const STATUS = [
        self::STATUS_UNPAID => '待支付',
        self::STATUS_PAID => '已支付',
        self::STATUS_CLOSED => '已关闭'
    ];

    const TYPE_QUOTE_ORDER = 0;
    const TYPE_ADDITION_ORDER = 1;

    const ORDER_TYPE = [
        self::TYPE_QUOTE_ORDER => '报价费用',
        self::TYPE_ADDITION_ORDER => '追加费用'
    ];

    const PAY_TYPE_AL = 0;
    const PAY_TYPE_WX = 1;
    const PAY_TYPE_BANK = 2;
    const PAY_TYPE_CASH = 3;

    const PAY_TYPE = [
        self::PAY_TYPE_AL => '支付宝',
        self::PAY_TYPE_WX => '微信支付',
        self::PAY_TYPE_BANK => '银联',
        self::PAY_TYPE_CASH => '现金'
    ];
    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function (PaymentOrder $model) {
            // 如果模型的 no 字段为空
            if (!$model->code) {
                // 调用 findAvailableNo 生成订单流水号
                $model->code = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->code) {
                    return false;
                }
            }
        });
    }
    /**
     * 状态描述
     */
    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function getAmountAttribute()
    {
        return $this->attributes['amount'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        // TODO: Implement getPresenterClass() method.
        return PaymentOrderPresenter::class;
    }

    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::whereCode($no)->exists()) {
                return $no;
            }
        }

        return false;
    }

}
