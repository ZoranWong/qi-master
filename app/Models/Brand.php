<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property int $categoryId 类别ID
 * @property string $name 品牌名称
 * @property int $sort 排序
 * @property int $status 状态：0-关闭 1-开启
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Category $category
 * @property-read mixed $statusDesc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand inactive()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Brand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Brand withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Brand withoutTrashed()
 * @mixin \Eloquent
 */
class Brand extends Model
{
    use SoftDeletes, ModelAttributesAccess;

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
