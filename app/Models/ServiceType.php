<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ServiceType
 *
 * @property int $id
 * @property string $name 服务名称
 * @property string $description 描述
 * @property string $tips 服务类型提示
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ServiceType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ServiceType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ServiceType withoutTrashed()
 * @mixin \Eloquent
 */
class ServiceType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'tips'];

    protected $dates = [
        'deleted_at'
    ];

    protected $casts = [
        'tips' => 'array'
    ];

    public function classifications(): BelongsToMany
    {
        return $this->belongsToMany(Classification::class, 'classification_services',
            'service_id', 'classification_id');
    }
}
