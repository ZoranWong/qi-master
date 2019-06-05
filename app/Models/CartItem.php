<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CartItem
 *
 * @property int $id
 * @property int $userId
 * @property int $productSkuId
 * @property int $amount
 * @property-read ProductSku $productSku
 * @property-read User $user
 * @method static Builder|CartItem newModelQuery()
 * @method static Builder|CartItem newQuery()
 * @method static Builder|CartItem query()
 * @method static Builder|CartItem whereAmount($value)
 * @method static Builder|CartItem whereId($value)
 * @method static Builder|CartItem whereProductSkuId($value)
 * @method static Builder|CartItem whereUserId($value)
 * @mixin \Eloquent
 */
class CartItem extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['amount'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }
}
