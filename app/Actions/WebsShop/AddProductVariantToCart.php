<?php

namespace App\Actions\WebsShop;

use App\Factories\CartFactory;


class AddProductVariantToCart {

    public function add($variantId){



        // This is the fourth setup of the cart [ We added the auto Incrementing of the quantity ]
        CartFactory::make()->items()->firstOrCreate([
            'product_variant_id' => $variantId,
        ],
        [
            'quantity' => 0,
        ])->increment('quantity');


         //  This is the third setup

        // CartFactory::make()->items()->create([
        //     'product_variant_id' => $variantId,
        //     'quantity' => 1,
        // ]);


        //  This is the second setup

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


        //  This is the first setup of the cart

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
