<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceRequirement
 *
 * @property int $id
 * @property int $serviceId 服务关系ID
 * @property int $categoryId 类别ID
 * @property string $name 要求名称
 * @property array $value 要求
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\ServiceType $service
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceRequirement whereValue($value)
 * @mixin \Eloquent
 */
class ServiceRequirement extends Model
{
    protected $fillable = ['service_id', 'category_id', 'name', 'value'];

    protected $casts = [
        'value' => 'array'
    ];

    public function service()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
