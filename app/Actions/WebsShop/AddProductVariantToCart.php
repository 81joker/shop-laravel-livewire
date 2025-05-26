<?php

namespace App\Actions\WebsShop;

use App\Factories\CartFactory;
use App\Models\Cart;


class AddProductVariantToCart {

    public function add($variantId){


         // to do the third setup
        CartFactory::make()->items()->create([
            'product_variant_id' => $variantId,
            'quantity' => 1,
        ]);


        // to do the second setup
        // $cart = match(auth()->guest()) {
        //     true => Cart::firstOrCreate([
        //     'session_id' => session()->getId(),
        //     ]),
        //     false => auth()->user()->cart() ?: auth()->user()->cart()->create(),
        // };
        
        // $cart->items()->create([
        //     'product_variant_id' => $variantId,
        //     'quantity' => 1,
        // ]);


       

        // To Test the first setup of the cart
        // if (auth()->guest()) {
        //     $cart = Cart::firstOrCreate([
        //         'session_id' => session()->getId(),
        //     ]);
        // }
        // if (auth()->user()) {
        //     $cart = auth()->user()->cart() ?:auth()->user()->cart()->create();
        // }
        // $cart->variants()->attach($variantId);
    }
}
