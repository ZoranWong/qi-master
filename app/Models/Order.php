<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $no
 * @property int $userId
 * @property string $address
 * @property float $totalAmount
 * @property string|null $remark
 * @property \Illuminate\Support\Carbon|null $paidAt
 * @property int|null $couponCodeId
 * @property string|null $paymentMethod
 * @property string|null $paymentNo
 * @property string $refundStatus
 * @property string|null $refundNo
 * @property int $closed
 * @property int $reviewed
 * @property string $shipStatus
 * @property string|null $shipData
 * @property string|null $extra
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\CouponCode|null $couponCode
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCouponCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReviewed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShipData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShipStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order withoutTrashed()
 * @mixin \Eloquent
 */
class Order extends Model
{
    use SoftDeletes, ModelAttributesAccess;

    const STATUS_REFUND_APPLYING = 1;
    const STATUS_REFUND_AGREED = 2;
    const STATUS_REFUND_REFUSED = 3;
    const STATUS_REFUND = [
        self::STATUS_REFUND_APPLYING => '申请中',
        self::STATUS_REFUND_AGREED => '已退款',
        self::STATUS_REFUND_REFUSED => '拒绝退款'
    ];

    const STATUS_WAITING = 0;
    const STATUS = [];

    protected $fillable = [
        'order_no',
        'user_id',
        'refund_status',
        'master_id',
        'type',
        'status',
        'total_amount',
        'coupon_code_id'
    ];

    protected $dates = [
        'paid_at',
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->no) {
                // 调用 findAvailableNo 生成订单流水号
                $model->no = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    /**
     * 所属用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 师傅
     */
    public function master()
    {
        return $this->belongsTo(Master::class);
    }
    /**
     * 资金明细
     * 由初始订单 和 追加费用 组成
     */
    public function payments()
    {
        return $this->hasMany(PaymentOrder::class);
    }

    /**
     * 产品明细
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function couponCode()
    {
        return $this->belongsTo(CouponCode::class);
    }

    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }

    public static function getAvailableRefundNo()
    {
        do {
            // Uuid类可以用来生成大概率不重复的字符串
            $no = Uuid::uuid4()->getHex();
            // 为了避免重复我们在生成之后在数据库中查询看看是否已经存在相同的退款订单号
        } while (self::query()->where('refund_no', $no)->exists());

        return $no;
    }
}
