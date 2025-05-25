<?php

use App\Livewire\Product;
use App\Livewire\StoreFront;
use Illuminate\Support\Facades\Route;

Route::get('/', StoreFront::class)->name('home');
Route::get('/product/{productId}', Product::class)->name('product');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
