<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MasterComment.
 *
 * @property int $id
 * @property int $userId 评论用户ID
 * @property int $masterId 被评论师傅ID
 * @property int $orderId 订单ID
 * @property int $type 综合评分类型
 * @property array $labels 标签
 * @property array $rates 评分 如quality,attitude,speed
 * @property string $content 评论内容
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read mixed $typeDesc
 * @property-read \App\Models\Master $master
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereLabels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereRates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterComment whereUserId($value)
 * @mixin \Eloquent
 */
class MasterComment extends Model implements Transformable
{
    use TransformableTrait, ModelAttributesAccess;

    const TYPE_GOOD = 1;
    const TYPE_NORMAL = 2;
    const TYPE_BAD = 3;
    const TYPES = [
        self::TYPE_GOOD => '好评',
        self::TYPE_NORMAL => '中评',
        self::TYPE_BAD => '差评'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'master_id', 'order_id', 'type', 'labels', 'rates', 'content'];

    protected $casts = [
        'labels' => 'array',
        'rates' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function master()
    {
        return $this->belongsTo(Master::class, 'master_id');
    }

    public function getTypeDescAttribute()
    {
        return self::TYPES[$this->type];
    }
}
