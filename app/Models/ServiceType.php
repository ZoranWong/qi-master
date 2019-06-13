<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\ServiceType
 *
 * @property int $id
 * @property string $name 服务名称
 * @property string $description 描述
 * @property string $tips 服务类型提示
 * @property Carbon|null $deletedAt
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
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

    protected $fillable = ['name', 'description', 'tips'];

    protected $dates = [
        'deleted_at'
    ];

    protected $casts = [
        'tips' => 'array'
    ];

    /**
     * 应用到的类别
     * @return BelongsToMany
     */
    public function classifications(): BelongsToMany
    {
        return $this->belongsToMany(Classification::class, 'classification_services',
            'service_id', 'classification_id');
    }
}
