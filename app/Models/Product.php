<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Storage;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title 产品型号（产品名称）
 * @property string $image 产品图片
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property int $classificationId 类目
 * @property int|null $serviceId 服务类型ID
 * @property int $categoryId 类别ID
 * @property int $childCategoryId 子类别ID
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $childCategories
 * @property-read \App\Models\Category $childCategory
 * @property-read \App\Models\Classification $classification
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classification[] $classifications
 * @property-read mixed $imageUrl
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereChildCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'classification_id', 'category_id', 'child_category_id', 'title', 'image'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::saving(function (Product $product) {
            if($product->childCategoryId === null) {
                $product->setAttribute('child_category_id', 0);
            }
        });
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class, 'classification_product', 'product_id', 'classification_id');
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id',
            'category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function childCategories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id',
            'child_category_id');
    }

    public function childCategory()
    {
        return $this->belongsTo(Category::class, 'child_category_id');
    }


    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return Storage::disk('public')->url($this->attributes['image']);
    }
}
