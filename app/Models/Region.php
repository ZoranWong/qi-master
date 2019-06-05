<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Eloquent;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Region
 * @property string $regionCode 行政编号
 * @property string $parentCode 上级行政区域
 * @property string $name 行政区名称
 * @property int $status 状态：0-关闭服务 1-开启服务
 * @property-read mixed $statusDesc
 * @property-read Region|null $parent
 * @method static Builder|Region newModelQuery()
 * @method static Builder|Region newQuery()
 * @method static Builder|Region query()
 * @method static Builder|Region whereRegionCode($value)
 * @method static Builder|Region whereParentCode($value)
 * @method static Builder|Region whereName($value)
 * @method static Builder|Region whereStatus($value)
 * @mixin Eloquent
 */
class Region extends Model
{
    use SoftDeletes, ModelAttributesAccess;

    protected $fillable = ['region_code', 'parent_code', 'name', 'status'];

    protected $dates = [
        'deleted_at'
    ];

    const STATUS_ON = 1;
    const STATUS_OFF = 0;
    const STATUS = [
        self::STATUS_ON => '开启',
        self::STATUS_OFF => '关闭'
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function (self &$region) {
            if (!isset($region->parentCode)) {
                $region->parentCode = $region->getParentCodeByAnalyze();
            }
        });
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ON);
    }

    public function scopeInactive(Builder $query)
    {
        return $query->where('status', self::STATUS_OFF);
    }

    /**
     * description: 上级行政区
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_code', 'region_code');
    }

    /**
     * 国标代码后4位为0的为省或直辖市
     */
    public function isProvince()
    {
        return substr($this->regionCode, -4, 4) === '0000';
    }

    /**
     * 国标代码后两位为0的为市
     */
    public function isCity()
    {
        return !$this->isProvince() && substr($this->regionCode, -2, 2) === '00';
    }

    /**
     * 国标代码不属于省且不属于市的为区县代码
     */
    public function isDistrict()
    {
        return !$this->isProvince() && !$this->isCity();
    }

    /**
     * 根据当前的国标代码获取所在省
     */
    public function getProvinceCode()
    {
        return intval(substr($this->regionCode, 0, 2) . '0000');
    }

    public function getCityCode()
    {
        return intval(substr($this->regionCode, 0, 4) . '00');
    }

    /**
     * 获取父级国标代码
     * 省->0 | 市->省 | 区县->市
     */
    public function getParentCodeByAnalyze()
    {
        if ($this->isProvince()) {
            return 0;
        } else if ($this->isCity()) {
            return $this->getProvinceCode();
        } else {
            return $this->getCityCode();
        }
    }

    /**
     * description: 状态描述
     */
    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }

    /**
     * description: 根据国标代码获取区域名称
     * @param string $regionCode
     * @return Repository|mixed
     */
    public static function getRegionNameByCode(string $regionCode)
    {
        return config("regionalism-codes.{$regionCode}");
    }
}
