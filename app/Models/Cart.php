<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Cart
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @mixin \Eloquent
 */
class Cart extends Model
{
    protected $primaryKey = 'cart_id';

    protected $fillable = ['user_id', 'total',];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class, 
            'carts_have_products', 
            'cart_id', 'product_id',
            'cart_id', 'product_id',
        )->withPivot('quantity', 'subtotal') ;
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function calcularTotal()
        {
            $total = 0;
            foreach ($this->products as $product) {
                $total += $product->pivot->subtotal;
            }
            $this->total = $total->total(); ;
        }
}
