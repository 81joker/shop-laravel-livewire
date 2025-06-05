<?php

namespace App\Livewire;

use Livewire\Component;
use App\Factories\CartFactory;

class Cart extends Component
{

    public function checkout()
    {
        // https://laravel.com/docs/12.x/billing#checkout
        return auth()->user()->checkout([
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'unit_amount' => 100, // amount in cents ($1.00)
                        'product_data' => [
                            'name' => 'My Product',
                            'metadata' => [
                                'product_id' => '1',
                                'variant_id' => '1',
                            ],
                        ],
                        
                    ],
                    'quantity' => 2
            ]
        ]);
    }


    public function getCartProperty()
    {
        return CartFactory::make()->loadMissing([
            'items',
            'items.product',
            'items.variant',
        ]);
        // return CartFactory::make();
    }


    public function getItemsProperty()
    {
        return $this->cart->items;
        // return CartFactory::make()->items;
    }

    public function delete($itemId)
    {

        // CartFactory::make()->items()->find($itemId)->delete();
        $this->cart->items()->where('id', $itemId)->delete();
        $this->dispatch('productRemovedFromCart');
        // $this->dispatch('productRemovedFromCart', ['itemId' => $itemId]);
    }

    public function increment($itemId)
    {
        // CartFactory::make()->items()->find($itemId)->increment('quantity');
        $this->cart->items()->find($itemId)->increment('quantity');
        // CartFactory::make()->items()->where('id', $itemId)->increment('quantity');
        $this->dispatch('productQuantityUpdated');
    }
    public function decrement($itemId)
    {
        $item = $this->cart->items()->find($itemId);

        if ($item && $item->quantity > 1) {
            $item->decrement('quantity');
            // $this->dispatch('productQuantityUpdated');
        }
        // elseif ($item) {
        //     $this->delete($itemId);
        // }
    }

    public function render()
    {
        return view('livewire.cart')->layout('layouts.app');
    }
}
