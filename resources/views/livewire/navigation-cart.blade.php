<x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
   {{ __('Your Count Cart') }} ({{ $this->count() }})
</x-nav-link>