<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Classification
 *
 * @property int $id
 * @property string $name 名称
 * @property string $icon_url 图标路径
 * @property bool $is_hot 是否热门
 * @property bool $is_new 是否新服务
 * @property int $sort 排序
 * @property int $status 状态：0-关闭， 1-开启
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $statusDesc
 * @property-read Collection|null $serviceTypes
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newQuery()
 * @method static Builder|Classification onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereIconUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereIsHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUpdatedAt($value)
 * @method static Builder|Classification withTrashed()
 * @method static Builder|Classification withoutTrashed()
 * @mixin Eloquent
 */
class Classification extends Model
{
    use SoftDeletes;

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
}
