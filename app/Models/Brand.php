<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property int $category_id 类别ID
 * @property string $name 品牌名称
 * @property int $sort 排序
 * @property int $status 状态：0-关闭 1-开启
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category $category
 * @property-read mixed $status_desc
 * @method static Builder|Brand active()
 * @method static bool|null forceDelete()
 * @method static Builder|Brand inActive()
 * @method static Builder|Brand newModelQuery()
 * @method static Builder|Brand newQuery()
 * @method static \Illuminate\Database\Query\Builder|Brand onlyTrashed()
 * @method static Builder|Brand query()
 * @method static bool|null restore()
 * @method static Builder|Brand whereCategoryId($value)
 * @method static Builder|Brand whereCreatedAt($value)
 * @method static Builder|Brand whereDeletedAt($value)
 * @method static Builder|Brand whereId($value)
 * @method static Builder|Brand whereName($value)
 * @method static Builder|Brand whereSort($value)
 * @method static Builder|Brand whereStatus($value)
 * @method static Builder|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Brand withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Brand withoutTrashed()
 * @mixin Eloquent
 */
class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = ['category_id', 'name', 'sort', 'status'];

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
     * 所属商品类别
     */
    public function category()
    {
        return $this->belongsTo(Category::class)->withoutGlobalScope(SoftDeletingScope::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ON);
    }

    public function scopeInactive(Builder $query)
    {
        return $query->where('status', self::STATUS_OFF);
    }

    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }
}
