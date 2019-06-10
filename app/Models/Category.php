<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property int $classificationId 类目ID
 * @property string $name 类别名称
 * @property int $parentId 父类别ID
 * @property int $sort 排序
 * @property string $unit 产品单位
 * @property int $price 报价 单位：分
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $children
 * @property-read \App\Models\Classification $classification
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Measurement[] $measurements
 * @property-read \App\Models\Category $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CategoryProperty[] $properties
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category withoutTrashed()
 * @mixin \Eloquent
 */
class Category extends Model
{
    use SoftDeletes, ModelAttributesAccess;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->extraAttributeCasts = [
            'price' => function ($price) {
                return $price * 100;
            }
        ];
    }

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

    public function getPriceAttribute()
    {
        return $this->attributes['price'] / 100;
    }
}
