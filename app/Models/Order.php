<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\OrderPresenter;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Log;
use McCool\LaravelAutoPresenter\HasPresenter;
use Ramsey\Uuid\Uuid;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $orderNo 订单编号
 * @property int $userId 订单发布用户id
 * @property int $refundStatus 退款状态
 * @property int $masterId 雇佣师傅ID
 * @property int $type 订单类型
 * @property int $status 订单状态
 * @property int $totalAmount 订单总金额,单位：分
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property string|null $deletedAt
 * @property int|null $couponCodeId
 * @property string|null $serviceDate 服务时间
 * @property string|null $comment 备注
 * @property string $contactUserName 联系人姓名
 * @property string $contactUserPhone 联系人电话
 * @property string $customerName 客户名称
 * @property string $customerPhone 客户电话
 * @property string $regionCode 行政区域编号
 * @property string $customerAddress 服务地址
 * @property-read CouponCode|null $couponCode
 * @property-read Collection|OfferOrder[] $employedMasters
 * @property-read Collection|OrderItem[] $items
 * @property-read Master $master
 * @property-read Collection|Master[] $masters
 * @property-read Collection|OfferOrder[] $offerOrders
 * @property-read Collection|PaymentOrder[] $payments
 * @property-read Collection|RefundOrder[] $refundOrders
 * @property-read User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static Builder|Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereContactUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereContactUserPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @method static Builder|Order withTrashed()
 * @method static Builder|Order withoutTrashed()
 * @mixin Eloquent
 */
class Order extends Model implements HasPresenter
{
    use SoftDeletes, ModelAttributesAccess, CurrencyUnitTrait;

    const ORDER_TYPE_FIXED_PRICE = 0;
    const ORDER_TYPE_QUOTE_PRICE = 1;

    const ORDER_TYPE = [
        self::ORDER_TYPE_FIXED_PRICE => '一口价单',
        self::ORDER_TYPE_QUOTE_PRICE => '报价单'
    ];

    const ORDER_WAIT_EMPLOY = 0; // 待接单
    const ORDER_EMPLOYED = 1; // 已接单
    const ORDER_WAIT_CHECK = 2;// 待验收
    const ORDER_CHECKED = 3;// 验收完成，待评价
    const ORDER_COMPLETED = 4;// 订单完成
    const ORDER_CANCEL = 5;// 订单关闭

    const ORDER_STATUS = [
        self::ORDER_WAIT_EMPLOY => '待接单',
        self::ORDER_EMPLOYED => '已接单',
        self::ORDER_WAIT_CHECK => '待验收',
        self::ORDER_CHECKED => '已验收',
        self::ORDER_COMPLETED => '订单完成',
        self::ORDER_CANCEL => '订单关闭'
    ];

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

    public function __construct(array $attributes = [])
    {
        $this->currencyColumns = ['total_amount'];
        $this->accessorAndMutator();
        parent::__construct($attributes);

    }

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function (Order $model) {
            // 如果模型的 no 字段为空
            if (!$model->orderNo) {
                // 调用 findAvailableNo 生成订单流水号
                $model->orderNo = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->orderNo) {
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

    public function masters()
    {
        return $this->belongsToMany(Master::class, 'order_items', 'order_id', 'master_id');
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

    public function offerOrders()
    {
        return $this->hasMany(OfferOrder::class);
    }

    public function refundOrders()
    {
        return $this->hasMany(RefundOrder::class);
    }

    public function employedMasters()
    {
        return $this->belongsToMany(OfferOrder::class, 'masters', 'order_id', 'master_id');
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
        Log::warning('find order no failed');

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

    public function setTotalAmountAttribute($value)
    {
        $this->attributes['total_amount'] = $value * 100;
    }

    public function getTotalAmountAttribute()
    {
        return $this->attributes['total_amount'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        // TODO: Implement getPresenterClass() method.
        return OrderPresenter::class;
    }
}
