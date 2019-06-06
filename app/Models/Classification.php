<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

/**
 * App\Models\Classification
 *
 * @property int $id
 * @property string $name 名称
 * @property string $iconUrl 图标路径
 * @property bool $isHot 是否热门
 * @property bool $isNew 是否新服务
 * @property int $sort 排序
 * @property int $status 状态：0-关闭， 1-开启
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read mixed $statusDesc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceType[] $serviceTypes
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Classification onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereIconUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereIsHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Classification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Classification withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Classification withoutTrashed()
 * @mixin \Eloquent
 */
class Classification extends Model
{
    use SoftDeletes, ModelAttributesAccess;

    protected $fillable = ['name', 'icon_url', 'is_hot', 'is_new', 'sort', 'status'];

    protected $casts = [
        'is_new' => 'boolean',
        'is_hot' => 'boolean'
    ];

    protected $dates = [
        'deleted_at'
    ];

    const STATUS_ON = 1;
    const STATUS_OFF = 0;
    const STATUS = [
        self::STATUS_ON => '开启',
        self::STATUS_OFF => '关闭'
    ];

    /**
     * 可取服务类型
     */
    public function serviceTypes()
    {
        return $this->hasManyThrough(ServiceType::class, ClassificationService::class, 'classification_id', 'service_id')
            ->withoutGlobalScope(SoftDeletingScope::class);
    }

    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function getIconUrlAttribute($icon_url)
    {
        return getImageUrl($icon_url);
    }
}
