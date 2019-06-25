<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\OfferOrderPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

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
 * @property int|null $orderItemId 子订单ID
 * @property-read \App\Models\Master $master
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\OrderItem|null $orderItem
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereOrderItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereQuotePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfferOrder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OfferOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OfferOrder withoutTrashed()
 * @mixin \Eloquent
 */
class OfferOrder extends Model implements HasPresenter
{
    use SoftDeletes, ModelAttributesAccess, CurrencyUnitTrait;

    protected $fillable = ['user_id', 'master_id', 'status', 'quote_price', 'order_id', 'order_item_id'];

    protected $dates = ['deleted_at'];

    const STATUS_WAIT = 0;
    const STATUS_HIRED = 1;
    const STATUS_REFUSED = 2;
    const STATUS = [
        self::STATUS_WAIT => '待雇佣',
        self::STATUS_HIRED => '已雇佣',
        self::STATUS_REFUSED => '被拒绝'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function setQuotePriceAttribute($value)
    {
        $this->attributes['quote_price'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getQuotePriceAttribute()
    {
        return $this->attributes['quote_price'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        // TODO: Implement getPresenterClass() method.
        return OfferOrderPresenter::class;
    }
}
