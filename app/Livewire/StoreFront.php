<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class StoreFront extends Component
{

    public function getProductsProperty()
    {
        return Product::query()->orderBy('created_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.store-front')->layout('layouts.app');
    }
}
