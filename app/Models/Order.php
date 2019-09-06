<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\OrderPresenter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property string|null $deletedAt
 * @property int|null $couponCodeId
 * @property \Illuminate\Support\Carbon|null $serviceDate 服务时间
 * @property string $contactUserName 联系人姓名
 * @property string $contactUserPhone 联系人电话
 * @property array $customerInfo 客户信息
 * @property string $regionCode 行政区域编号
 * @property int $classificationId 类目
 * @property int $serviceId 服务类型ID
 * @property string $remark 订单备注
 * @property string $image 图片
 * @property array $shippingInfo 快递信息
 * @property array|null $products 产品
 * @property \Illuminate\Support\Carbon|null $reservationDate 预约时间
 * @property \Illuminate\Support\Carbon|null $checkInDate 签到时间
 * @property \Illuminate\Support\Carbon|null $pickUpDate 提货日期
 * @property int $needSecondaryService 是否需要二次上门
 * @property string|null $secondaryServiceDate 二次上门时间
 * @property \Illuminate\Support\Carbon|null $reqCheckDate 请求
 * @property \Illuminate\Support\Carbon|null $orderCheckedDate 确认完成
 * @property string $orderCheckedCode 验收码
 * @property-read \App\Models\Classification $classification
 * @property-read \App\Models\MasterComment $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Complaint[] $complaints
 * @property-read \App\Models\CouponCode|null $couponCode
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferOrder[] $employedMasters
 * @property-read mixed $statusDesc
 * @property-read mixed $typeDesc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read \App\Models\Master $master
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master[] $masters
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferOrder[] $offerOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PaymentOrder[] $payments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefundOrder[] $refundOrders
 * @property-read \App\Models\ServiceType $serviceType
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCheckInDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereContactUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereContactUserPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCouponCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCustomerInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereNeedSecondaryService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderCheckedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderCheckedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePickUpDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReqCheckDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReservationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSecondaryServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order withoutTrashed()
 * @mixin \Eloquent
 */
class Order extends Model implements HasPresenter
{
    use SoftDeletes, ModelAttributesAccess, CurrencyUnitTrait;

    const ORDER_TYPE_FIXED_PRICE = 0;
    const ORDER_TYPE_QUOTE_PRICE = 1;
    const ORDER_TYPE_IMMEDIATE_HIRE = 2;

    const ORDER_TYPE = [
        self::ORDER_TYPE_FIXED_PRICE => '一口价单',
        self::ORDER_TYPE_QUOTE_PRICE => '报价单',
        self::ORDER_TYPE_IMMEDIATE_HIRE => '直接雇佣'
    ];

    const ORDER_WAIT_OFFER = 0; // 待报价
    const ORDER_WAIT_HIRE = 1;// 待雇佣
    const ORDER_EMPLOYED = 2; // 待托管，待支付，已雇佣
    const ORDER_PROCEEDING_WAIT_PRE_APPOINT = 4;// 服务中-待预约客户
    const ORDER_PROCEEDING_APPOINTED = 8;// 服务中-已预约客户
    const ORDER_PROCEEDING_PRODUCT_RECEIVED = 16;// 服务中-已提货签收
    const ORDER_PROCEEDING_SIGNED = 32;// 服务中-已上门签到(待完成)
    const ORDER_WAIT_CHECK = 64;// 待验收(待收款,确认验收即打款)
    const ORDER_CHECKED = 128;// 验收完成，待评价
    const ORDER_COMPLETED = 256;// 订单完成
    const ORDER_CLOSED = 512;// 订单关闭

    const OVER_DATE = 24;

    const ORDER_STATUS = [
        '待报价',
        '待雇佣',
        '待支付',
        '待预约客户',
        '已预约客户',
        '已提货签收',
        '已上门签到',
        '待验收',
        '已验收',
        '订单完成',
        '订单关闭'
    ];


    const STATUS_REFUND_DEFAULT = 0;
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
        'image',
        'refund_status',
        'master_id',
        'type',
        'status',
        'total_amount',
        'remark',
        'coupon_code_id',
        'service_date',
        'comment',
        'contact_user_name',
        'contact_user_phone',
        'region_code',
        'classification_id',
        'service_id',
        'customer_info',
        'shipping_info',
        'products',
        'reservation_date',
        'check_in_date',
        'pick_up_date',
        'need_secondary_service',
        'secondary_date',
        'req_check_date',
        'order_checked_date',
        'order_checked_code',
    ];

    protected $dates = [
        'paid_at',
        'service_date',
        'reservation_date',
        'check_in_date',
        'pick_up_date',
        'secondary_date',
        'req_check_date',
        'order_checked_date',
    ];

    protected $casts = [
        'customer_info' => 'array',
        'shipping_info' => 'array',
        'products' => 'array'
    ];

    protected $attributes = [
        'refund_status' => self::STATUS_REFUND_DEFAULT,
        'remark' => '',
        'customer_info' => '[]',
        'shipping_info' => '[]'
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

    /**
     * 报价单
     */
    public function offerOrders()
    {
        return $this->hasMany(OfferOrder::class);
    }

    /**
     * 退款单
     */
    public function refundOrders()
    {
        return $this->hasMany(RefundOrder::class);
    }

    /**
     * 主动雇佣报价单
     */
    public function employedMasters()
    {
        return $this->belongsToMany(OfferOrder::class, 'masters', 'order_id', 'master_id');
    }

    /**
     * 类目
     */
    public function classification()
    {
        return $this->belongsTo(Classification::class, 'classification_id');
    }

    /**
     * 服务类型
     */
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'service_id');
    }

    public function couponCode()
    {
        return $this->belongsTo(CouponCode::class);
    }

    /**
     * 投诉
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'order_id');
    }

    /**
     * 订单跟踪
     */
    public function traces()
    {
        // TODO
    }

    /**
     * 订单评价
     */
    public function comment()
    {
        return $this->hasOne(MasterComment::class);
    }

    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::whereOrderNo($no)->exists()) {
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
     * 订单状态描述
     */
    public function getStatusDescAttribute()
    {
        $step = 0;
        while (($tmp = $this->status >> $step)) {
            $step ++;
        }
        return Order::ORDER_STATUS[$step];
    }

    /**
     * 订单类型描述
     */
    public function getTypeDescAttribute()
    {
        return self::ORDER_TYPE[$this->type];
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

    /**/
    public function resetTime()
    {
        return $this->endAt()->timestamp - time();
    }

    public function resetTimeFormat($format)
    {
        return $this->endAt()->diff(Carbon::now())->format($format);
    }

    /**
     * @return Carbon
     * */
    public function endAt()
    {
        return $this->createdAt->addHours(self::OVER_DATE);
    }

}
