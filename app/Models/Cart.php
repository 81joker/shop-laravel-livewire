<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\CartItem;
use Money\Money;
use Money\Currency;
class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    protected $fillable = [
        'session_id',
        'user_id'];


protected function total(): Attribute
{
    return Attribute::make(
        get: function () {
            return $this->items->reduce(function (Money $total, CartItem $item) {
                $subtotal = $item->subtotal instanceof Money
                    ? $item->subtotal
                    : new Money($item->subtotal, new Currency('USD'));

                return $total->add($subtotal);
            }, new Money(0, new Currency('USD')));
        }
    );
}


    public function items(): HasMany{
        return $this->hasMany(CartItem::class);
    }
}

