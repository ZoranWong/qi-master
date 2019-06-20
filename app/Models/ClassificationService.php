<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ClassificationService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassificationService query()
 * @mixin \Eloquent
 */
class ClassificationService extends Pivot
{
    use ModelAttributesAccess;

    protected $fillable = ['classification_id', 'service_id'];
}
