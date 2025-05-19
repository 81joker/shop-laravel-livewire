<div  class="grid grid-cols-4 gap-4 mt-12">

    @foreach ($this->products as $product)
        {{-- @livewire('product-card', ['product' => $product]) --}}
        <div class="bg-white shadow rounded-lg p-4 overflow-hidden">
            <img src="{{ $product->image->path }}" alt="{{ $product->name }}">
           <h2 class="font-medium text-lg">{{ $product->name }}</h2>
           <span class="text-gray-700 text-sm">{{ $product->price }}</span>
        </div>
    @endforeach
</div>
