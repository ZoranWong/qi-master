<?php

namespace App\Models;

use App\Exceptions\CouponCodeUnavailableException;
use App\Models\Traits\ModelAttributesAccess;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\CouponCode
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property float $value
 * @property int $total
 * @property int $used
 * @property float $minAmount
 * @property \Illuminate\Support\Carbon|null $notBefore
 * @property \Illuminate\Support\Carbon|null $notAfter
 * @property bool $enabled
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @property-read mixed $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereNotAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereNotBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CouponCode whereValue($value)
 * @mixin \Eloquent
 */
class CouponCode extends Model
{
    use ModelAttributesAccess;

    // 用常量的方式定义支持的优惠券类型
    const TYPE_FIXED = 'fixed';
    const TYPE_PERCENT = 'percent';

    public static $typeMap = [
        self::TYPE_FIXED => '固定金额',
        self::TYPE_PERCENT => '比例',
    ];

    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'total',
        'used',
        'min_amount',
        'not_before',
        'not_after',
        'enabled',
    ];
    protected $casts = [
        'enabled' => 'boolean',
    ];
    // 指明这两个字段是日期类型
    protected $dates = ['not_before', 'not_after'];

    protected $appends = ['description'];

    protected $attributes = [
        'name' => '',
        'min_amount' => 0
    ];
    public function getDescriptionAttribute()
    {
        $str = '';

        if ($this->minAmount > 0) {
            $str = '满' . str_replace('.00', '', $this->minAmount);
        }
        if ($this->type === self::TYPE_PERCENT) {
            return $str . '优惠' . str_replace('.00', '', $this->value) . '%';
        }

        return $str . '减' . str_replace('.00', '', $this->value);
    }

    /**
     *
     * @param User $user
     * @param null $orderAmount
     * @throws CouponCodeUnavailableException
     */
    public function checkAvailable(User $user, $orderAmount = null)
    {
        if (!$this->enabled) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

        if ($this->total - $this->used <= 0) {
            throw new CouponCodeUnavailableException('该优惠券已被兑完');
        }

        if ($this->notBefore && $this->notBefore->gt(Carbon::now())) {
            throw new CouponCodeUnavailableException('该优惠券现在还不能使用');
        }

        if ($this->notAfter && $this->notAfter->lt(Carbon::now())) {
            throw new CouponCodeUnavailableException('该优惠券已过期');
        }

        if (!is_null($orderAmount) && $orderAmount < $this->minAmount) {
            throw new CouponCodeUnavailableException('订单金额不满足该优惠券最低金额');
        }

        $used = Order::where('user_id', $user->id)
            ->where('coupon_code_id', $this->id)
            ->where(function ($query) {
                /**@var Builder $query*/
                $query->where(function ($query) {
                    /**@var Builder $query*/
                    $query->whereNull('paid_at')
                        ->where('closed', false);
                })->orWhere(function ($query) {
                    /**@var Builder $query*/
                    $query->whereNotNull('paid_at')
                        ->where('refund_status', '!=', Order::STATUS_REFUND_AGREED);
                });
            })->exists();
        if ($used) {
            throw new CouponCodeUnavailableException('你已经使用过这张优惠券了');
        }
    }

    public function getAdjustedPrice($orderAmount)
    {
        // 固定金额
        if ($this->type === self::TYPE_FIXED) {
            // 为了保证系统健壮性，我们需要订单金额最少为 0.01 元
            return max(0.01, $orderAmount - $this->value);
        }

        return number_format($orderAmount * (100 - $this->value) / 100, 2, '.', '');
    }

    public function changeUsed($increase = true)
    {
        // 传入 true 代表新增用量，否则是减少用量
        if ($increase) {
            // 与检查 SKU 库存类似，这里需要检查当前用量是否已经超过总量
            return $this->newQuery()->where('id', $this->id)->where('used', '<', $this->total)->increment('used');
        } else {
            return $this->decrement('used');
        }
    }

    public static function findAvailableCode($length = 16)
    {
        do {
            // 生成一个指定长度的随机字符串，并转成大写
            $code = strtoupper(Str::random($length));
            // 如果生成的码已存在就继续循环
        } while (self::query()->where('code', $code)->exists());

        return $code;
    }
}
