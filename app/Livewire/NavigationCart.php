<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Component;
use Livewire\Attributes\On;

class NavigationCart extends Component
{
    #[On('productAddedToCart')]
    #[On('productRemovedFromCart')]
    public function refreshCart()
    {
        $this->dispatch('productAddedToCart');
        $this->dispatch('productRemovedFromCart');
    }

    /**
     * Get the count of items in the cart.
     *
     * @return int
     */
    #[Component]
    #[On('productAddedToCart')]
    public function count()
    {
        return CartFactory::make()->items()->sum('quantity');
        // CartFactory::make()->items()->count();
    }


    public function render()
    {
        return view('livewire.navigation-cart');
    }
}
