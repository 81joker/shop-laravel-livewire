<?php

namespace App\Livewire;

use App\Models\Product as ModelsProduct;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;
use App\Actions\WebsShop\AddProductVariantToCart;

class Product extends Component
{
    use InteractsWithBanner;
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
         $cart->add(
            variantId: $this->variant
         );

        $this->banner('Your Product has been added to cart');

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


// $this->banner('الرسالة') - رسالة عادية

// $this->dangerBanner('الرسالة') - رسالة خطأ (حمراء)

// $this->successBanner('الرسالة') - رسالة نجاح (خضراء)

// $this->warningBanner('الرسالة') - رسالة تحذير (صفراء)
