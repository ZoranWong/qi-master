<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CartItem
 *
 * @property-read \App\Models\ProductSku $productSku
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartItem query()
 * @mixin \Eloquent
 */
class CartItem extends Model
{
    use ModelAttributesAccess;

    protected $fillable = ['user_id', 'product_sku_id', 'amount'];
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
