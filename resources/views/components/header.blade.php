<header class="text-gray-900">
    <nav class="text-black px-6 py-3 pt-5 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" alt="logo" class="w-6/12">
            </a>
        </div>
        <div class="flex items-center space-x-4 text-black">
            <ul class="hidden lg:flex items-center space-x-8">
                <li><a href="/" class="hover:text-blue-400">Home</a></li>
                @foreach($headerLinks as $headerLink)
                    <li><a href="{{ route('page', $headerLink->slug) }}"
                           class="hover:text-blue-500">{{ $headerLink->title }}</a></li>
                @endforeach
                <li><a href="{{ route('contact') }}" class="hover:text-blue-500">Contact Us</a></li>
            </ul>
            <button @click="open = true" type="button"
                    class="flex lg:hidden bg-white rounded-md p-2 inline-flex items-center justify-center text-black focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-400"
                    id="main-menu" aria-haspopup="true" x-bind:aria-expanded="open">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" x-description="Heroicon name: menu" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>
    <x-nav/>
</header>
