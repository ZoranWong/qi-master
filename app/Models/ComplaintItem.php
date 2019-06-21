<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ComplaintItem.
 *
 * @property int $id
 * @property int $complaintId 投诉ID
 * @property int $complainantId 申诉人ID
 * @property string $complainantType 申诉人类型，仅为user或者master
 * @property string $content 举证内容
 * @property array $evidence 举证内容，包含图片，音视频
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read mixed $complaintTypeName
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem whereComplainantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem whereComplainantType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem whereComplaintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem whereEvidence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComplaintItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ComplaintItem extends Model implements Transformable
{
    use TransformableTrait, ModelAttributesAccess;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'complaint_id', 'complainant_id', 'complainant_type', 'content', 'evidence'
    ];

    protected $casts = [
        'evidence' => 'array'
    ];

    const COMPLAINANT_TYPE_USER = 'user';
    const COMPLAINANT_TYPE_MASTER = 'master';
    const COMPLAINANT_TYPES = [
        self::COMPLAINANT_TYPE_USER => '用户',
        self::COMPLAINANT_TYPE_MASTER => '师傅',
    ];

    public function getComplaintTypeNameAttribute()
    {
        return self::COMPLAINANT_TYPES[$this->complainantType] . '举证';
    }
}
