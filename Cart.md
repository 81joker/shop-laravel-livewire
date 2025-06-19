
#- <x-button wire:click="checkout">Checkout</x-button>

 1- in the Cart Livewire Component:

    public function checkout(CreateStripeCheckoutSession $checkoutSession)
    {
        // https://laravel.com/docs/12.x/billing#checkout
        return $checkoutSession->createFromCart($this->cart);
        // return auth()->user()->checkout();
    }

    A- creat the inside  App\Actions\WebsShop => CreateStripeCheckoutSession is a class that uses the Stripe PHP SDK to create a checkout session.
