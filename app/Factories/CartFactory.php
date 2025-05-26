<?php

namespace App\Factories;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartFactory
{
    public static function make(): Cart
    {
        return match (Auth::guest()) {
            true => self::getOrCreateSessionCart(),
            false => self::getOrCreateUserCart(),
        };
    }

    protected static function getOrCreateSessionCart(): Cart
    {
        return Cart::firstOrCreate([
            'session_id' => session()->getId()
        ]);
    }

    protected static function getOrCreateUserCart(): Cart
    {
        return Auth::user()->cart()->firstOrCreate();
    }
}