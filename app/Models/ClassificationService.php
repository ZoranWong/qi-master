<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ClassificationService
 * 商品类别与服务类型中间表：商品1:n服务类型
 *
 * @property int $id
 * @property int $classification_id 类目ID
 * @property int $service_id 服务ID
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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
    protected $fillable = ['classification_id', 'service_id'];
}
