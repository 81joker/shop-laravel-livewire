<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_checkout_session_id',
        'amount_shipping',
        'acount_discount',
        'amount_tax',
        'amount_subtotal',
        'amount_total',
        'billing_address',
        'shipping_address',
    ];
    
    public $casts = [
        'billing_address' => 'collection',
        'shipping_address' => 'collection',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
     