<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ClassificationService
 * 商品类别与服务类型中间表：商品1:n服务类型
 *
 * @property int $id
 * @property int $classificationId 类目ID
 * @property int $serviceId 服务ID
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @method static Builder|ClassificationService newModelQuery()
 * @method static Builder|ClassificationService newQuery()
 * @method static Builder|ClassificationService query()
 * @method static Builder|ClassificationService whereClassificationId($value)
 * @method static Builder|ClassificationService whereCreatedAt($value)
 * @method static Builder|ClassificationService whereId($value)
 * @method static Builder|ClassificationService whereServiceId($value)
 * @method static Builder|ClassificationService whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ClassificationService extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['classification_id', 'service_id'];
}
