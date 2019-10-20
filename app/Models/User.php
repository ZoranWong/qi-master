<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\UserPresenter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use McCool\LaravelAutoPresenter\HasPresenter;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name 用户名
 * @property string $nickname 昵称
 * @property string $avatar 头像
 * @property string $email 邮箱
 * @property string $mobile 手机
 * @property string|null $emailVerifiedAt
 * @property string $password
 * @property string $walletPassword 钱包密码
 * @property string|null $rememberToken
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property int $sex 性别 0->保密 1->男 2->女
 * @property string|null $province 省份
 * @property string|null $city 城市
 * @property string|null $area 区
 * @property string $address 详细地址
 * @property int $balance 余额 单位：分
 * @property string $realName 姓名
 * @property int $status 用户状态1-激活 0-禁止
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MasterComment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Complaint[] $complaints
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $favoriteProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master[] $favouriteMasters
 * @property-read mixed $sexDesc
 * @property-read mixed $userCouponRecordCount
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefundOrder[] $refundOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CouponRecord[] $userCouponRecords
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWalletPassword($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail, JWTSubject, HasPresenter
{
    use Notifiable, ModelAttributesAccess, CurrencyUnitTrait;

    public function __construct(array $attributes = [])
    {
        $this->currencyColumns = ['balance'];

        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password', 'email_verified_at', 'remember_token',
        'nickname', 'avatar', 'sex', 'province', 'city', 'area', 'address', 'balance',
        'wallet_password', 'real_name', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const SEX_MALE = 1;
    const SEX_FEMALE = 2;
    const SEX_UNKNOWN = 0;
    const SEX = [
        self::SEX_UNKNOWN => '保密',
        self::SEX_MALE => '男性',
        self::SEX_FEMALE => '女性'
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function (self &$user) {
            $user->nickname = $user->mobile;
//            $user->name = '';
            return $user;
        });
    }

    public function userCouponRecords()
    {
        return $this->hasMany(CouponRecord::class);
    }

    public function getUserCouponRecordCountAttribute()
    {
        return $this['user_coupon_records_count'] ? $this['user_coupon_records_count']  : $this->userCouponRecords->count();
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'user_favorite_products')
            ->withTimestamps()
            ->orderBy('user_favorite_products.created_at', 'desc');
    }

    /**
     * 我的订单
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * 待报价单
     */
    public function orderWaitOffer()
    {
        return $this->orders()
            ->where('status', Order::ORDER_WAIT_OFFER);
    }

    /**
     * 待雇佣单
     */
    public function orderWaitHire()
    {
        return $this->orders()
            ->where('status', Order::ORDER_WAIT_HIRE);
    }

    /**
     * 待支付单
     */
    public function orderWaitPay()
    {
        return $this->orders()
            ->where('status', Order::ORDER_EMPLOYED);
    }

    /**
     * 待验收
     */
    public function orderWaitCheck()
    {
        return $this->orders()
            ->where('status', Order::ORDER_WAIT_CHECK);
    }

    /**
     * 待评价
     */
    public function orderWaitComment()
    {
        return $this->orders()
            ->where('status', Order::ORDER_CHECKED);
    }

    public function runningOrders()
    {
        return $this->orders();
    }

    /**
     * 已完成订单
     */
    public function completedOrders()
    {
        return $this->orders()
            ->where('status', Order::ORDER_COMPLETED);
    }

    /**
     * 我的投诉
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * 消息
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'member_id')->where('member_type', TYPE_USER);
    }

    /**
     * 未读消息
     */
    public function newMessages()
    {
        return $this->messages()->where('status', Message::STATUS_NEW);
    }

    /**
     * 我的评论
     */
    public function comments()
    {
        return $this->hasMany(MasterComment::class, 'user_id');
    }

    /**
     * 我的师傅收藏
     */
    public function favouriteMasters(): BelongsToMany
    {
        return $this->belongsToMany(Master::class, 'favourite_masters', 'user_id', 'master_id')
            ->withPivot('remark')->withTimestamps();
    }

    /**
     * 我的退款记录
     */
    public function refundOrders()
    {
        return $this->hasMany(RefundOrder::class);
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
            'guard' => 'users'
        ];
    }

    public function getSexDescAttribute()
    {
        return self::SEX[$this->sex];
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        // TODO: Implement getPresenterClass() method.
        return UserPresenter::class;
    }

    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getBalanceAttribute()
    {
        return $this->attributes['balance'] / CURRENCY_UNIT_CONVERT_NUM;
    }
}
