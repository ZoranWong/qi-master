<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MasterService
 *
 * @property int $id
 * @property int $masterId 师傅ID
 * @property string $regionCode 服务区域代码
 * @property string $type 服务区域类型
 * @property int $weight 权重
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\Classification $classification
 * @property-read \App\Models\Region $region
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService whereMasterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MasterService whereWeight($value)
 * @mixin \Eloquent
 */
class MasterService extends Model
{
    use ModelAttributesAccess;
    protected $fillable = [
        'master_id', 'region_code', 'type', 'weight'
    ];

    const TYPE_CORE = 'CORE';
    const TYPE_KEY = 'KEY';
    const TYPE_OTHER = 'OTHER';
    const TYPES = [
        self::TYPE_CORE => '核心服务区域',
        self::TYPE_KEY => '重点服务区域',
        self::TYPE_OTHER => '其余服务区域'
    ];

    const WEIGHT_CORE = 10;
    const WEIGHT_KEY = 5;
    const WEIGHT_OTHER = 1;

    /**
     * 服务类目
     */
    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_code', 'region_code');
    }

}
