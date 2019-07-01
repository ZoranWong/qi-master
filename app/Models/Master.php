<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
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
 * @property-read \App\Models\Region|null $area
 * @property-read \App\Models\Region|null $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MasterComment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferOrder[] $offerOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \App\Models\Region|null $province
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefundOrder[] $refundOrders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereAreaCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmergencyMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereProvinceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereWalletPassword($value)
 * @mixin \Eloquent
 */
class Master extends Model implements JWTSubject, Authenticatable, MustVerifyEmail
{
    use ModelAttributesAccess, CurrencyUnitTrait, \Illuminate\Auth\Authenticatable, \Illuminate\Auth\MustVerifyEmail;

    protected $fillable = ['name', 'real_name', 'avatar', 'mobile', 'email', 'mobile', 'email_verified_at', 'password', 'remember_token'];

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
        return $this->orders()->where('status', Order::ORDER_EMPLOYED);
    }

    /**
     * 我的服务中订单
     */
    public function orderOnProceeding()
    {
        return $this->orders()->where('status', Order::ORDER_PROCEEDING);
    }

    /**
     * 我的已完成订单
     */
    public function orderCompleted()
    {
        return $this->orders()->where('status', Order::ORDER_COMPLETED);
    }

    /**
     * 我的已完成订单
     */
    public function completedOrders()
    {
        return $this->orders()->where('status', Order::ORDER_COMPLETED);
    }

    /**
     * 我的待验收订单
     */
    public function orderWaitCheck()
    {
        return $this->orders()->where('status', Order::ORDER_WAIT_CHECK);
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
     * 我的服务区域
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
    public function comments()
    {
        return $this->hasMany(MasterComment::class);
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
}
