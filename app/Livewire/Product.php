<?php

namespace App\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Component;
use App\Actions\WebsShop\AddProductVariantToCart;

class Product extends Component
{
    public $productId;
    public $variant;

    public $rules = [
        'variant' => ['required' , 'exists:App\Models\ProductVariant,id'],
    ];

    public function mount()
    {
        $this->variant = $this->product->variants->value('id');
        // $this->variant = $this->product->variants->first->id;
    }

    public function addToCart(AddProductVariantToCart $cart){
         $this->validate();
         $cart->add();
        // return $this->emit('addToCart', $this->productId, $this->variant);
    }

    public function getProductProperty()
    {
        // return Product::find($this->productId);
        return ModelsProduct::findOrFail($this->productId);
    }

    public function render()
    {

        return view('livewire.product')->layout('layouts.app');;
    }
}
