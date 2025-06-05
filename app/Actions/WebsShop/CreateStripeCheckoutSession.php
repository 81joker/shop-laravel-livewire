<?php

namespace App\Actions\WebsShop;

use App\Livewire\Cart;
use Illuminate\Database\Eloquent\Collection;

class CreateStripeCheckoutSession
{
    public function createFromCart(Cart $cart)
    {
        // https://laravel.com/docs/12.x/billing#checkout
        $items = $cart->items;
        return \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $this->formmatCreatItem($items),
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);
    }

    private function formmatCreatItem(Collection $items): array
    {
        // to call the relationship 'product' on each item
        return $items->loadMissing('product')->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $item->product->price->getAmount(),
                    'product_data' => [
                        'name' => $item->product->name,
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