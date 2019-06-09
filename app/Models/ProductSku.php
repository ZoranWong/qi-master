<?php

namespace App\Models;

use App\Exceptions\InternalException;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductSku
 *
 * @property int $id
 * @property int $productId
 * @property mixed $specArr 规格
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property-read Product $product
 * @method static Builder|ProductSku newModelQuery()
 * @method static Builder|ProductSku newQuery()
 * @method static Builder|ProductSku query()
 * @method static Builder|ProductSku whereCreatedAt($value)
 * @method static Builder|ProductSku whereId($value)
 * @method static Builder|ProductSku whereProductId($value)
 * @method static Builder|ProductSku whereSpecArr($value)
 * @method static Builder|ProductSku whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ProductSku extends Model
{
    protected $fillable = ['product_id', 'spec_arr'];

    protected $casts = [
        'spec_arr' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('减库存不可小于0');
        }

        return $this->newQuery()->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }
}
