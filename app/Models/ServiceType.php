<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\ServiceType
 *
 * @property int $id
 * @property string $name 服务名称
 * @property string $description 描述
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType newQuery()
 * @method static Builder|ServiceType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereUpdatedAt($value)
 * @method static Builder|ServiceType withTrashed()
 * @method static Builder|ServiceType withoutTrashed()
 * @mixin Eloquent
 */
class ServiceType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    protected $dates = [
        'deleted_at'
    ];
}
