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
 * @property-read \App\Models\Region $area
 * @property-read \App\Models\Region $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferOrder[] $offerOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \App\Models\Region $province
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereProvinceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereUpdatedAt($value)
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
        return $this->hasMany(Order::class, 'master_id');
    }

    public function offerOrders()
    {
        return $this->hasMany(OfferOrder::class);
    }

    public function completedOrders()
    {
        return $this->offerOrders();
    }

    public function runningOrders()
    {
        return $this->offerOrders();
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
