<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClassificationService
 *
 * @property int $id
 * @property int $classificationId 类目ID
 * @property int $serviceId 服务ID
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClassificationService extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['classification_id', 'service_id'];
}
