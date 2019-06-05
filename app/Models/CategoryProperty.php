<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\CategoryProperty
 *
 * @property int $id
 * @property int $categoryId 类别ID
 * @property string $title 属性标题
 * @property array $value 属性值["1", "2", "3"]
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @method static Builder|CategoryProperty newModelQuery()
 * @method static Builder|CategoryProperty newQuery()
 * @method static Builder|CategoryProperty query()
 * @method static Builder|CategoryProperty whereCategoryId($value)
 * @method static Builder|CategoryProperty whereCreatedAt($value)
 * @method static Builder|CategoryProperty whereId($value)
 * @method static Builder|CategoryProperty whereTitle($value)
 * @method static Builder|CategoryProperty whereUpdatedAt($value)
 * @method static Builder|CategoryProperty whereValue($value)
 * @mixin Eloquent
 */
class CategoryProperty extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['category_id', 'title', 'value'];

    protected $casts = [
        'value' => 'array'
    ];
}
