<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\RefundOrder
 *
 * @property int $id
 * @property int $amount 退款金额
 * @property int $orderId 订单ID
 * @property int $status 状态
 * @property int $userId 用户ID
 * @property int $masterId 师傅ID
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RefundOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RefundOrder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RefundOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RefundOrder withoutTrashed()
 * @mixin \Eloquent
 */
class RefundOrder extends Model
{
    use SoftDeletes, ModelAttributesAccess;

    protected $fillable = ['amount', 'order_id', 'status', 'user_id', 'master_id', 'payment_order_id'];

    protected $dates = ['deleted_at'];
}
