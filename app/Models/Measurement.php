<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Measurement
 *
 * @property int $id
 * @property int $categoryId 类别ID
 * @property string $name 名称：如长、宽、高、重量、体积等
 * @property string $unit 单位:如cm、kg、g、立方厘米等
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @method static Builder|Measurement newModelQuery()
 * @method static Builder|Measurement newQuery()
 * @method static Builder|Measurement query()
 * @method static Builder|Measurement whereCategoryId($value)
 * @method static Builder|Measurement whereCreatedAt($value)
 * @method static Builder|Measurement whereId($value)
 * @method static Builder|Measurement whereName($value)
 * @method static Builder|Measurement whereUnit($value)
 * @method static Builder|Measurement whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Measurement extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['category_id', 'name', 'unit'];
}
