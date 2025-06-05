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
                'allow_promotion_codes' => true,
                'customer_update' => [
                    'shipping' => 'auto',
                    // 'address' => 'auto',
                ],
                'shipping_address_collection' => [
                    'allowed_countries' => ['US', 'AT'], // Adjust as needed
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
