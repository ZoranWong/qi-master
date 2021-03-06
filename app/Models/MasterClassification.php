<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MasterClassification
 *
 * @property int $id
 * @property int $masterId 师父ID
 * @property int $classificationId 类目
 * @property array $services 服务类型
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Classification $classification
 * @property-read \App\Models\Master $master
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification whereServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterClassification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MasterClassification extends Model
{
    protected $table = 'master_classification';

    protected $casts = [
        'services' => 'array'
    ];
    protected $fillable = ['master_id', 'classification_id', 'services'];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function __toString()
    {
        $services = implode('/', collect($this->services)->map(function ($service) {
            return $service['name'];
        })->toArray());
        return "{$this->classification}({$services})"; // TODO: Change the autogenerated stub
    }
}
