<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PaymentOrder
 *
 * @property int $id
 * @property int $amount 支付金额
 * @property int $orderId 订单ID
 * @property int $status 状态
 * @property int $userId 用户ID
 * @property int $masterId 师傅ID
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property-read string $statusDesc
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentOrder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PaymentOrder withoutTrashed()
 * @mixin \Eloquent
 */
class PaymentOrder extends Model
{
    use SoftDeletes, ModelAttributesAccess;

    protected $fillable = ['amount', 'order_id', 'status', 'user_id', 'master_id'];

    protected $dates = ['deleted_at'];

    const STATUS_UNPAID = 1;
    const STATUS_PAID = 2;
    const STATUS_CLOSED = 3;
    const STATUS = [
        self::STATUS_UNPAID => '待支付',
        self::STATUS_PAID => '已支付',
        self::STATUS_CLOSED => '已关闭'
    ];

    /**
     * 状态描述
     */
    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }
}
