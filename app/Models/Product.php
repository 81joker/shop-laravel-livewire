<?php

namespace App\Models;

use App\Models\Image;
use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Money\Money;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'main_image_id',
    ];
    protected function price(): Attribute
    {
        return Attribute::make(
            get: function (int $value) {
                return new Money($value, new \Money\Currency('USD'));
            },
            // set: fn ($value) => $value * 100,
            // get: fn ($value) => $value / 100,
            // set: fn ($value) => $value * 100,
        );
    }


    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class)->ofMany('featured' , 'max');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
