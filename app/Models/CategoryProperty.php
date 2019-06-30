<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryProperty
 *
 * @property int $id
 * @property int $categoryId 类别ID
 * @property string $title 属性标题
 * @property array $value 属性值["1", "2", "3"]
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProperty whereValue($value)
 * @mixin \Eloquent
 */
class CategoryProperty extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['category_id', 'title', 'value'];

    protected $casts = [
        'value' => 'array'
    ];

}
