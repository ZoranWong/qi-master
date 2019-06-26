<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use App\Presenters\OrderItemPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $orderId 订单ID
 * @property int $productId 产品ID
 * @property array $product 产品快照
 * @property int $installFee 安装费用
 * @property int $otherFee 其他费用
 * @property int $status 订单状态
 * @property int $type 订单类型
 * @property int $masterId 雇佣师傅ID
 * @property string|null $deletedAt
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property-read \App\Models\Master $master
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $orderProduct
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereInstallFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereOtherFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderItem withoutTrashed()
 * @mixin \Eloquent
 */
class OrderItem extends Model implements HasPresenter
{
    use SoftDeletes, ModelAttributesAccess, CurrencyUnitTrait;

    protected $casts = [
        'product' => 'array'
    ];

    protected $fillable = [
        'order_id', 'product_id', 'product', 'install_fee', 'other_fee', 'status', 'type', 'master_id', 'num'
    ];
    protected $dates = ['reviewed_at'];
    public $timestamps = false;

    public function orderProduct()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function setInstallFeeAttribute($value)
    {
        $this->attributes['install_fee'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function setOtherFeeAttribute($value)
    {
        $this->attributes['other_fee'] = $value * CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getInstallFeeAttribute()
    {
        return $this->attributes['install_fee'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    public function getOtherFeeAttribute()
    {
        return $this->attributes['other_fee'] / CURRENCY_UNIT_CONVERT_NUM;
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        // TODO: Implement getPresenterClass() method.
        return OrderItemPresenter::class;
    }
}
