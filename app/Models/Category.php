<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property int $classification_id 类目ID
 * @property string $name 类别名称
 * @property int $parent_id 父类别ID
 * @property int $sort 排序
 * @property string $unit 产品单位
 * @property int $price 报价 单位：分
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Classification $classification
 * @property-read Category|null $parent
 * @property-read Collection|null $children
 * @property-read Collection|null $properties
 * @property-read Collection|null $serviceRequirements
 * @property-read Collection|null $measurements
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static Builder|Category withTrashed()
 * @method static Builder|Category withoutTrashed()
 * @mixin Eloquent
 */
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['classification_id', 'name', 'parent_id', 'sort', 'unit', 'price'];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * 所属服务类目
     */
    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    /**
     * 父级商品类别
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * 直接子类别
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * 拓展属性|额外属性
     */
    public function properties()
    {
        return $this->hasMany(CategoryProperty::class);
    }

    /**
     * 服务要求|服务需求|额外服务报价
     * @param int $serviceTypeId 服务类型ID
     * @return HasMany
     */
    public function serviceRequirements(int $serviceTypeId)
    {
        return $this->hasMany(ServiceRequirement::class)->where('service_id', $serviceTypeId);
    }

    /**
     * 规格数据
     */
    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }
}

