<?php

namespace App\Actions\WebsShop;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

class CreateStripeCheckoutSession
{
     public function createFromCart(Cart $cart)
    {
        // https://laravel.com/docs/12.x/billing#checkout
       return $cart->user
       ->checkout($this->formmatCreatItem($cart->items),
            [
                // https://docs.stripe.com/billing/subscriptions/coupons#add-promotion-codes-to-checkout
                // https://docs.stripe.com/api/checkout/sessions/object#checkout_session_object-allow_promotion_codes
                'allow_promotion_codes' => true,
                'customer_update' => [
                    'shipping' => 'auto',
                    // 'address' => 'auto',
                ],
                // https://docs.stripe.com/api/checkout/sessions/object#checkout_session_object-shipping_address_collection
                'shipping_address_collection' => [
                    'allowed_countries' => ['US', 'AT','DE'], // Adjust as needed
                ],
                // https://docs.stripe.com/api/checkout/sessions/object#checkout_session_object-shipping_cost-amount_subtotal
                // 'shipping_cost' => [
                //     'amount_subtotal' => $cart->total(),
                   
                // ],
                'metadata' => [
                    'cart_id' => $cart->id,
                    'user_id' => $cart->user->id,
                ],
                // 'payment_method_types' => ['card'],
                // 'line_items' => $this->formmatCreatItem($cart->items),
                // 'mode' => 'payment',
                // 'success_url' => route('cart.success'),
                // 'cancel_url' => route('cart.index'),
            ]);
    }
    private function formmatCreatItem(Collection $items): array
    {
        // to call the relationship 'product' on each item
        return $items->loadMissing('product' , 'variant')->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $item->product->price,
                    // 'unit_amount' => $item->product->price->getAmount(),
                    'product_data' => [
                        'name' => $item->product->name,
                        'description' => "Size: {$item->variant->size}, Color: {$item->variant->color}",

                        'metadata' => [
                            'product_id' => $item->product->id,
                            'variant_id' => $item->product_variant_id,
                            // 'product_id' => $item->product_variant->product_id,
                            // 'variant_id' => $item->product_variant_id,
                        ],
                    ],
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();
    }
}
