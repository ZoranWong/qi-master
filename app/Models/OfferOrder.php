<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\OfferOrder
 *
 * @property int $id
 * @property int $userId 用户ID
 * @property int $masterId 师傅ID
 * @property int $status 状态：0-等待雇佣 1-雇佣 2-拒绝
 * @property int $quotePrice 报价
 * @property int $orderId 订单ID
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OfferOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereQuotePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OfferOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OfferOrder withoutTrashed()
 * @mixin \Eloquent
 */
class OfferOrder extends Model
{
    use SoftDeletes, ModelAttributesAccess;

    protected $fillable = ['user_id', 'master_id', 'status', 'quote_price', 'order_id'];

    protected $dates = ['deleted_at'];

    const STATUS_WAIT = 0;
    const STATUS_HIRED = 1;
    const STATUS_REFUSED = 2;
    const STATUS = [
        self::STATUS_WAIT => '带雇佣',
        self::STATUS_HIRED => '已雇佣',
        self::STATUS_REFUSED => '被拒绝'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function master()
    {
//        return $this->belongsTo()
    }
}
