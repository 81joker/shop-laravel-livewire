<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductVariant extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'color',
        'size',
        // 'stock',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
