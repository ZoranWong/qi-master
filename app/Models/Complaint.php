<?php

namespace App\Models;

use App\Models\Traits\CurrencyUnitTrait;
use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Complaint.
 *
 * @property int $id
 * @property string $complaintNo 投诉编号
 * @property int $orderId 订单ID
 * @property string $orderNo 订单编号
 * @property int $status 状态
 * @property int $evidenceStatus 举证状态
 * @property int $complaintTypeId 投诉类型
 * @property array $complaintInfo 投诉信息，包括投诉内容，图片凭证
 * @property int $compensation 赔付金额
 * @property array $result 处理结果
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read \App\Models\ComplaintType $complaintType
 * @property-read mixed $evidenceStatusDesc
 * @property-read mixed $statusDesc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ComplaintItem[] $items
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereCompensation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereComplaintInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereComplaintNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereComplaintTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereEvidenceStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Complaint whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Complaint extends Model implements Transformable
{
    use TransformableTrait, CurrencyUnitTrait, ModelAttributesAccess;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'complaint_no', 'order_id', 'order_no', 'status', 'evidence_status',
        'complaint_type_id', 'complaint_info', 'result', 'compensation'
    ];

    protected $casts = [
        'complaint_info' => 'array',
        'result' => 'array'
    ];

    const STATUS_PROCEEDING = 1;
    const STATUS_FINISHED = 2;
    const STATUS_CLOSE = 3;
    const STATUS = [
        self::STATUS_PROCEEDING => '处理中',
        self::STATUS_FINISHED => '投诉完成',
        self::STATUS_CLOSE => '投诉关闭'
    ];

    // 举证过程，成败与否
    const STATUS_EVIDENCE_WAIT_COMPLAINANT = 1;
    const STATUS_EVIDENCE_WAIT_MASTER = 2;
    const STATUS_EVIDENCE_WAIT_CUSTOMER = 3;
    const STATUS_EVIDENCE_WAIT_CUSTOMER_TITLE = 4;
    const STATUS_EVIDENCE_SUCCEED = 5;
    const STATUS_EVIDENCE_FAILED = 6;
    const STATUS_EVIDENCE_CANCELED = 7;
    const STATUS_EVIDENCE = [
        self::STATUS_EVIDENCE_WAIT_COMPLAINANT => '等待用户举证',
        self::STATUS_EVIDENCE_WAIT_MASTER => '等待师傅举证',
        self::STATUS_EVIDENCE_WAIT_CUSTOMER => '等待客服处理',
        self::STATUS_EVIDENCE_WAIT_CUSTOMER_TITLE => '客服通知用户补充证据',
        self::STATUS_EVIDENCE_SUCCEED => '投诉成立',
        self::STATUS_EVIDENCE_FAILED => '投诉不成立',
        self::STATUS_EVIDENCE_CANCELED => '取消投诉',
    ];

    public function __construct(array $attributes = [])
    {
        $this->currencyColumns = ['compensation'];

        parent::__construct($attributes);
    }


    /**
     * 投诉追踪项
     */
    public function items(): HasMany
    {
        return $this->hasMany(ComplaintItem::class, 'complaint_id');
    }

    /**
     * 投诉类型
     */
    public function complaintType()
    {
        return $this->belongsTo(ComplaintType::class, 'complaint_type_id');
    }

    /**
     * 涉及订单
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getStatusDescAttribute()
    {
        return static::STATUS[$this->status];
    }

    public function getEvidenceStatusDescAttribute()
    {
        return static::STATUS_EVIDENCE[$this->evidenceStatus];
    }
}
