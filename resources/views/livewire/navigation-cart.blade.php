<x-nav-link href="{{ route('cart') }}" :active="request()->routeIs('cart')">
   {{ __('Your Count Cart') }} ({{ $this->count() }})
</x-nav-link>