<?php
namespace App\Actions\WebsShop;


use App\Factories\CartFactory;
use App\Models\Cart;
use App\Actions\WebsShop\AddProductVariantToCart;


class MigrateSessionCart
{
    /**
     * Migrate the session cart to the authenticated user's cart.
     *
     * @return void
     */


    public function migrate(Cart $sessionCart, Cart $userCart){
        $sessionCart->items->each(fn($item) => (new AddProductVariantToCart)->add(
            variantId: $item->product_variant_id,
            quantity: $item->quantity,
            cart: $userCart
        ));
        $sessionCart->items()->delete();
        $sessionCart->delete();
    }

    /* 
    public function migrate()
    {
        if (auth()->guest()) {
            return;
        }

        $cart = auth()->user()->cart() ?: auth()->user()->cart()->create();

        $sessionCart = CartFactory::make();

        foreach ($sessionCart->items as $item) {
            $cart->items()->updateOrCreate(
                ['product_variant_id' => $item->product_variant_id],
                ['quantity' => $item->quantity]
            );
        }

        // Clear the session cart after migration
        $sessionCart->items()->delete();
    }

    */
}