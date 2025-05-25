<div class="grid grid-cols-2 gap-10 my-12">
<div class="space-y-4" x-data="{ image: '/{{ $this->product->image->path }}' }">

    <div class="bg-white shadow rounded-lg p-5 overflow-hidden relative">
        <img  x-bind:src="image" src="" alt="{{ $this->product->name }}" class="w-full">
        {{-- <img src="/{{ $this->product->image->path }}" alt="{{ $this->product->name }}" class="w-full"> --}}
    </div>
    
    <div class="grid grid-cols-4 gab-y-4 gap-x-4">
        @foreach ($this->product->images as $image)
        <div class="bg-white shadow rounded-lg p-2">
            <img src="/{{ $image->path }}" @click="image = '/{{ $image->path }}'" alt="{{ $this->product->name }}" class="rounded cursor-pointer">
            {{-- <img src="/{{ $image->path }}" alt="{{ $this->product->name }}" class="rounded"> --}}
        </div>
        @endforeach
    </div>

</div>

<div>
    <h1 class="text-3xl front-medium">{{ $this->product->name }}</h1>
    <span class="text-gray-700 text-sm">{{ $this->product->price }}</span>
    <div class="mt-4">
        {{ $this->product->description }}
    </div>

    <div class="mt-4 space-y-4">
       <select name="" id="" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-800">
       {{-- <select name="" id="" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"> --}}
           @foreach ($this->product->variants as $variant)
               <option value="{{ $variant->id }}" class=""> {{ $variant->size }} / {{ $variant->color }} </option>
           @endforeach
       </select>


        @error('variant')
            <div class="mt-2 text-red-600">{{ $message }}</div>    
        @enderror
        <x-button wire:click="addToCart" >Add to cart</x-button>
    </div>

    {{-- <div class="mt-6">
        @livewire('add-to-cart', ['product' => $this->product])
    </div> --}}
</div>
</div>
