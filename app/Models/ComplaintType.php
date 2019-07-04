<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComplaintType
 *
 * @property int $id
 * @property int $parentId 父类ID
 * @property string $name 投诉类型名称
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ComplaintType[] $children
 * @property-read \App\Models\ComplaintType $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType topLevel()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ComplaintType extends Model
{
    protected $fillable = ['id', 'parent_id', 'name'];

    public function scopeTopLevel(Builder $query)
    {
        return $query->where('parent_id', 0);
    }

    public function parent()
    {
        return $this->belongsTo(ComplaintType::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ComplaintType::class, 'parent_id')->with('children')
            ->select('id', 'name', 'parent_id');
    }
}
