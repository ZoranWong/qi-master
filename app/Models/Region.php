<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Region
 * @property string $regionCode 行政编号
 * @property string $parentCode 上级行政区域
 * @property string $name 行政区名称
 * @property int $status 状态：0-关闭服务 1-开启服务
 * @property-read mixed $statusDesc
 * @property-read Region|null $parent
 * @method static Builder|Region newModelQuery()
 * @method static Builder|Region newQuery()
 * @method static Builder|Region query()
 * @method static Builder|Region whereRegionCode($value)
 * @method static Builder|Region whereParentCode($value)
 * @method static Builder|Region whereName($value)
 * @method static Builder|Region whereStatus($value)
 * @mixin Eloquent
 */
class Region extends Model
{
    protected $fillable = ['region_code', 'parent_code', 'name', 'status'];

    protected $dates = [
        'deleted_at'
    ];

    const STATUS_ON = 1;
    const STATUS_OFF = 0;
    const STATUS = [
        self::STATUS_ON => '开启',
        self::STATUS_OFF => '关闭'
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ON);
    }

    public function scopeInactive(Builder $query)
    {
        return $query->where('status', self::STATUS_OFF);
    }

    /**
     * description: 上级行政区
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_code', 'region_code');
    }

    /**
     * description: 状态描述
     */
    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }
}
