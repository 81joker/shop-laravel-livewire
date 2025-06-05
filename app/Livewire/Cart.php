<?php

namespace App\Livewire;

use App\Actions\WebsShop\CreateStripeCheckoutSession;
use Livewire\Component;
use App\Factories\CartFactory;

class Cart extends Component
{

    public function checkout(CreateStripeCheckoutSession $checkoutSession)
    {
        // https://laravel.com/docs/12.x/billing#checkout
        return $checkoutSession->createFromCart($this->cart);
        // return auth()->user()->checkout();
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

    public function getAmount()
    {
        // return CartFactory::make()->amount;
        return $this->cart->amount;
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
