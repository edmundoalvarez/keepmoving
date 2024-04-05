<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Product
 *
 * @property int $product_id
 * @property string $name
 * @property int $price
 * @property string $description
 * @property string|null $image
 * @property string|null $image_description
 * @property int $size_id
 * @property int $color_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImageDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSizeId($value)
 * @property-read \App\Models\Color $color
 * @property-read \App\Models\Size $size
 * @property string|null $image_small
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImageSmall($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cart> $carts
 * @property-read int|null $carts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Size> $sizes
 * @property-read int|null $sizes_count
 * @mixin \Eloquent
 */
class Product extends Model
{

    protected $table = "products";

    protected $primaryKey = "product_id";

    protected $fillable = ['name', 'price', 'description','image','image_small', 'image_description', 'color_id'];

    public static $rules = [
        'name' => 'required|max:100',
        'price' => 'required|numeric',
        'description' => 'required',
        'image' => 'nullable',
        'image_small' => 'nullable',
        'image_description' => 'nullable',
        'color_id' => 'required',
    ];

    public static $errorMessages = [
        'name.required' => 'El nombre del producto es obligatorio',
        'name.max' => 'El nombre debe tener como máximo :max caracteres',
        'price.required' => 'El precio del producto es obligatorio',
        'price.numeric' => 'El precio debe ser escrito en números',
        'description.required' => 'La descripción del producto es obligatoria',
        'color_id.required' => 'Debés seleccionar un color',
    ];

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(
            Size::class, 
            'products_have_sizes',
            'product_id', 'size_id',
            'product_id', 'size_id',
        );
    }
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(
            Cart::class, 
            'carts_have_products',
            'product_id', 'cart_id',
            'product_id', 'cart_id',
        );
    }
    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(
            Cart::class, 
            'purchases_have_products',
            'product_id', 'purchase_id',
            'product_id', 'purchase_id',
        );
    }
}
