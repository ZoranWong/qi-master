<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\MasterPresenter;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use McCool\LaravelAutoPresenter\HasPresenter;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\Master
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $mobile
 * @property string|null $emailVerifiedAt
 * @property string $password
 * @property string|null $rememberToken
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property int $balance 余额
 * @property string|null $realName 师傅姓名
 * @property string $avatar 头像
 * @property string|null $provinceCode 省份代码
 * @property string|null $cityCode 城市代码
 * @property string|null $areaCode 区域代码
 * @property string|null $walletPassword 钱包密码
 * @property int $sex 性别 0->保密 1->男 2->女
 * @property string|null $emergencyMobile 紧急联系号码
 * @property string $address 详细地址
 * @property array|null $workDay 工作日
 * @property array|null $workTime 工作时间段
 * @property int $teamNums 团队人数
 * @property int $truckNums 货车数量
 * @property int $truckType 货车类型
 * @property float $truckTonnage 货车吨位
 * @property string $idCardNo 身份证号码
 * @property int $score 积分
 * @property-read \App\Models\Region|null $area
 * @property-read \App\Models\Region|null $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MasterComment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferOrder[] $offerOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \App\Models\Region|null $province
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefundOrder[] $refundOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MasterService[] $serviceAreas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MasterClassification[] $services
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereAreaCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmergencyMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereIdCardNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereProvinceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereTeamNums($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereTruckNums($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereTruckTonnage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereTruckType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereWalletPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereWorkDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereWorkTime($value)
 * @mixin \Eloquent
 */
class Master extends Model implements JWTSubject, Authenticatable, MustVerifyEmail, HasPresenter
{
    use ModelAttributesAccess, CurrencyUnitTrait, \Illuminate\Auth\Authenticatable, \Illuminate\Auth\MustVerifyEmail;

    protected $fillable = [
        'name', 'real_name', 'avatar', 'mobile', 'email', 'email_verified_at', 'password', 'remember_token',
        'balance', 'province_code', 'city_code', 'area_code', 'wallet_password', 'sex', 'emergency_mobile',
        'address', 'work_day', 'work_time', 'team_nums', 'truck_nums', 'truck_type', 'truck_tonnage', 'id_card_no',
        'score'
    ];

    protected $casts = [
        'work_day' => 'array',
        'work_time' => 'array'
    ];

    const TRUCK_TYPE_UNKNOWN = 0;
    const TRUCK_TYPE_SMALL = 1;
    const TRUCK_TYPE_MEDIUM = 2;
    const TRUCK_TYPE_LARGE = 3;
    const TRUCK_TYPES = [
        self::TRUCK_TYPE_UNKNOWN => '未知',
        self::TRUCK_TYPE_SMALL => '小型',
        self::TRUCK_TYPE_MEDIUM => '中型',
        self::TRUCK_TYPE_LARGE => '大型',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
//        self::creating(function (self &$master) {
//            $master->name = $master->mobile;
//        });
    }

    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getBalanceAttribute()
    {
        return $this->attributes['balance'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    /**
     * 我的订单
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * 我的报价
     */
    public function offerOrders()
    {
        return $this->hasMany(OfferOrder::class);
    }

    /**
     * 我的待托管订单，待支付订单
     */
    public function orderWaitPay()
    {
        return $this->orders()
            ->whereRaw('orders.status & ? = ?', [Order::ORDER_EMPLOYED, Order::ORDER_EMPLOYED])
            ->where('orders.status', '<=', 2 * Order::ORDER_EMPLOYED - 1);
    }

    /**
     * 我的待预约订单
     */
    public function orderWaitPreAppoint()
    {
        return $this->orders()
            ->whereRaw('orders.status & ? = ?', [Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT, Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT])
            ->where('orders.status', '<=', 2 * Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT - 1);
    }

    /**
     * 我的待上门订单
     */
    public function orderWaitSign()
    {
        return $this->orders()
            ->whereRaw('orders.status & ? = ?', [Order::ORDER_PROCEEDING_APPOINTED, Order::ORDER_PROCEEDING_APPOINTED])
            ->where('orders.status', '<=', 2 * Order::ORDER_PROCEEDING_APPOINTED - 1);
//        return $this->orders()->where('status', Order::ORDER_PROCEEDING_APPOINTED);
    }

    /**
     * 我的待完成订单（服务完成，非订单完成）
     */
    public function orderSigned()
    {
        return $this->orders()
            ->whereRaw('orders.status & ? = ?', [Order::ORDER_PROCEEDING_SIGNED, Order::ORDER_PROCEEDING_SIGNED])
            ->where('orders.status', '<=', 2 * Order::ORDER_PROCEEDING_SIGNED - 1);
//        return $this->orders()->where('status', Order::ORDER_PROCEEDING_SIGNED);
    }

    /**
     *
     */

    /**
     * 我的服务中订单
     */
    public function orderOnProceeding()
    {
        return $this->orders()->whereRaw('orders.status & ?', [
            Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT|Order::ORDER_PROCEEDING_APPOINTED|
            Order::ORDER_PROCEEDING_PRODUCT_RECEIVED|Order::ORDER_PROCEEDING_SIGNED
        ]);
    }

    /**
     * 我的已完成订单
     */
    public function orderCompleted()
    {
        return $this->orders()->whereRaw('orders.status & ?', [Order::ORDER_CHECKED|Order::ORDER_COMPLETED]);
    }

    /**
     * 我的已关闭订单
     */
    public function orderClosed()
    {
        return $this->orders()->whereRaw('orders.status & ? = ?', [Order::ORDER_CLOSED, Order::ORDER_CLOSED]);
    }

    /**
     * 我的已完成订单
     */
    public function completedOrders()
    {
        return $this->orders()->where('orders.status & ? = ?', [Order::ORDER_COMPLETED, Order::ORDER_COMPLETED]);
    }

    /**
     * 我的待验收订单
     */
    public function orderWaitCheck()
    {
        return $this->orders()
            ->whereRaw('orders.status & ? = ?', [Order::ORDER_WAIT_CHECK, Order::ORDER_WAIT_CHECK])
            ->where('orders.status', '<=', 2 * Order::ORDER_WAIT_CHECK - 1);
//        return $this->orders()->where('status', Order::ORDER_WAIT_CHECK);
    }

    /**
     * 我的待雇佣报价订单
     * 主动报价且被报价订单
     * 服务商确认
     */
    public function orderWaitHired()
    {
        return $this->offerOrders()->where('status', OfferOrder::STATUS_WAIT)
            ->whereHas('order', function ($query) {
                $query->where('type', '<>', Order::ORDER_TYPE_IMMEDIATE_HIRE);
            });
    }

    /**
     * 我的待同意接单订单，待确认订单
     * 用户确认
     */
    public function orderWaitAgree()
    {
        return $this->offerOrders()->where('status', OfferOrder::STATUS_WAIT)
            ->whereHas('order', function ($query) {
                $query->where('type', Order::ORDER_TYPE_IMMEDIATE_HIRE);
            });
    }

    /**
     * 消息
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'member_id')->where('member_type', TYPE_MASTER);
    }

    /**
     * 未读消息
     */
    public function newMessages()
    {
        return $this->messages()->where('status', Message::STATUS_NEW);
    }

    /**
     * 我的服务省份
     */
    public function province()
    {
        return $this->belongsTo(Region::class, 'province_code', 'region_code');
    }

    /**
     * 我的服务城市
     */
    public function city()
    {
        return $this->belongsTo(Region::class, 'city_code', 'region_code');
    }

    /**
     * 我的核心服务区域
     */
    public function area()
    {
        return $this->belongsTo(Region::class, 'area_code', 'region_code');
    }

    /**
     * 我的退款记录
     */
    public function refundOrders()
    {
        return $this->hasMany(RefundOrder::class);
    }

    /**
     * 我的评价
     */
    public function comments(): HasMany
    {
        return $this->hasMany(MasterComment::class);
    }

    /**
     * 我的服务区域
     */
    public function serviceAreas(): HasMany
    {
        return $this->hasMany(MasterService::class);
    }

    /**
     * 我的服务类目和服务类型
     */
    public function services(): HasMany
    {
        return $this->hasMany(MasterClassification::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'guard' => 'masters'
        ];
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        // TODO: Implement getPresenterClass() method.
        return MasterPresenter::class;
    }
}
