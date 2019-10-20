<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\CouponRecord
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $couponCodeId
 * @property string $type
 * @property float $value
 * @property int $total
 * @property int $used
 * @property float $minAmount
 * @property \Illuminate\Support\Carbon|null $notBefore
 * @property \Illuminate\Support\Carbon|null $notAfter
 * @property bool $enabled
 * @property int $userId
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\CouponCode $couponCode
 * @property-read mixed $description
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereCouponCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereNotAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereNotBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponRecord whereValue($value)
 * @mixin \Eloquent
 */
class CouponRecord extends CouponCode
{

    protected $table = "coupon_records";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'total',
        'used',
        'min_amount',
        'not_before',
        'not_after',
        'enabled',
        'user_id',
        'coupon_code_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function couponCode()
    {
        return $this->belongsTo(CouponCode::class);
    }

}
