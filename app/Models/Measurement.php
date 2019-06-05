<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Measurement
 *
 * @property int $id
 * @property int $categoryId 类别ID
 * @property string $name 名称：如长、宽、高、重量、体积等
 * @property string $unit 单位:如cm、kg、g、立方厘米等
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Measurement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Measurement extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['category_id', 'name', 'unit'];
}
