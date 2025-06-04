<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
    ];



    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->product->price * $this->quantity
        );
    }



    public function product(): HasOneThrough
    {
        return $this->hasOneThrough(
            Product::class,
            ProductVariant::class,
            'id', // Foreign key on product_variants table...
            'id', // Foreign key on products table...
            'product_variant_id', // Local key on cart_items table...
            'product_id' // Local key on product_variants table...
        );
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }
    // public function getTotalPriceAttribute()
    // {
    //     return $this->quantity * $this->productVariant->price;
    // }
}
