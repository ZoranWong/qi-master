<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\Master
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string|null $emailVerifiedAt
 * @property string $password
 * @property string|null $rememberToken
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property int $balance 余额
 * @property string $realName 师傅姓名
 * @property string $avatar 头像
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferOrder[] $offerOrders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Master whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Master extends Model implements JWTSubject, Authenticatable
{
    use ModelAttributesAccess, CurrencyUnitTrait, \Illuminate\Auth\Authenticatable;

    protected $fillable = ['name', 'email', 'mobile', 'email_verified_at', 'password', 'remember_token'];

    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getBalanceAttribute()
    {
        return $this->attributes['balance'] / CURRENCY_UNIT_CONVERT_NUM;
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
