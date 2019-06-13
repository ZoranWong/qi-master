<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ServiceRequirement
 *
 * @property int $id
 * @property int $serviceId 服务关系ID
 * @property int $categoryId 类别ID
 * @property string $name 要求名称
 * @property array $value 要求
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @method static Builder|ServiceRequirement newModelQuery()
 * @method static Builder|ServiceRequirement newQuery()
 * @method static Builder|ServiceRequirement query()
 * @method static Builder|ServiceRequirement whereCategoryId($value)
 * @method static Builder|ServiceRequirement whereCreatedAt($value)
 * @method static Builder|ServiceRequirement whereId($value)
 * @method static Builder|ServiceRequirement whereName($value)
 * @method static Builder|ServiceRequirement whereServiceId($value)
 * @method static Builder|ServiceRequirement whereUpdatedAt($value)
 * @method static Builder|ServiceRequirement whereValue($value)
 * @mixin Eloquent
 */
class ServiceRequirement extends Model
{
    protected $fillable = ['service_id', 'category_id', 'name', 'value'];

    protected $casts = [
        'value' => 'array'
    ];
}
