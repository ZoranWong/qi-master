<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\UserPresenter;
use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use McCool\LaravelAutoPresenter\HasPresenter;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property int $sex 性别 0->保密 1->男 2->女
 * @property string|null $province 省份
 * @property string|null $city 城市
 * @property string|null $area 区
 * @property string $address 详细地址
 * @property int $balance 余额 单位：分
 * @property-read Collection|UserAddress[] $addresses
 * @property-read Collection|MasterComment[] $comments
 * @property-read Collection|Complaint[] $complaints
 * @property-read Collection|Product[] $favoriteProducts
 * @property-read mixed $sexDesc
 * @property-read Collection|Message[] $messages
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read Collection|Order[] $orders
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAddress($value)
 * @method static Builder|User whereArea($value)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereBalance($value)
 * @method static Builder|User whereCity($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereMobile($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNickname($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereProvince($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSex($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereWalletPassword($value)
 * @mixin Eloquent
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
        'nickname', 'avatar', 'sex', 'province', 'city', 'area', 'address', 'balance', 'wallet_password'
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
            $user->name = '';
            return $user;
        });
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
        return $this->orders()->whereDoesntHave('offerOrders')
            ->where('status', Order::ORDER_WAIT_EMPLOY);
    }

    /**
     * 待雇佣单
     */
    public function orderWaitHire()
    {
        return $this->orders()->whereHas('offerOrders')
            ->where('status', Order::ORDER_WAIT_EMPLOY);
    }

    /**
     * 待支付单
     */
    public function orderWaitPay()
    {
        return $this->orders()->where('status', Order::ORDER_EMPLOYED);
    }

    /**
     * 待确认
     */
    public function orderWaitCheck()
    {
        return $this->orders()->where('status', Order::ORDER_WAIT_CHECK);
    }

    /**
     * 待评价
     */
    public function orderWaitComment()
    {
        return $this->orders()->where('status', Order::ORDER_CHECKED);
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
        return $this->orders()->where('status', Order::ORDER_COMPLETED);
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
