    <div class="grid grid-cols-4 mt-12 gap-4">
        <div class="bg-white rounded-lg shadow-md p-5 col-span-3">
            <table class="w-full">
                <thead>
                    <tr class="">
                        <th class="text-left">Product</th>
                        <th class="text-left">Price</th>
                        <th class="text-left">Color</th>
                        <th class="text-left">Size</th>
                        <th class="text-left">Quantity</th>
                        <th class="text-left">Total</th>
                        <th class="text-left">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->price }}</td>
                            <td>
                                <span class="inline-block border border-black w-4 h-4 rounded-full"
                                    style="background-color: {{ $item->variant->color }};"></span>
                            </td>
                            <td>{{ $item->variant->size }}</td>
                            <td class="flex items-center gap-2">
                                <button wire:click="decrement({{ $item->id }})" @disabled($item->quantity == 1)
                                    class="hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                    </svg>
                                </button>
                                {{ $item->quantity }}
                                <button wire:click="increment({{ $item->id }})" class="hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </td>
                            <td>${{ number_format($item->subtotal / 100, 2) }}</td>
                            <td>
                                <button wire:click="delete({{ $item->id }})"
                                    class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                       <td colspan="5" class="text-right font-medium">Total:</td>
                        <td colspan="2" class="font-medium">{{ $this->cart->total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="bg-white rounded-lg shadow-md p-5 col-span-1">
            <h4 class="text-lg font-semibold mb-4">Cart Summary</h4>
            @guest
                <p>Please <a href="/register" class="underline">Register</a> or <a href="/login"
                        class="underline">Login</a> to Countnie</p>
            @endguest

            @auth
                <x-button wire:click="addToCart">Add to cart</x-button>
            @endauth
        </div>
    </div>
