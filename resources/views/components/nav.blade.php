<div
    x-show="open"
    x-transition:enter="duration-150 ease-out"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="duration-100 ease-in"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right lg:hidden"
    style="display: none; z-index: 2;"
>
    <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
        <div class="px-5 pt-4 flex items-center justify-between">
            <div>
                <img class="h-8 w-auto" src="{{ asset('img/logo.png') }}" alt="">
            </div>
            <div class="-mr-2">
                <button @click="open = false" type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Close main menu</span>
                    <svg class="h-6 w-6" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div role="menu" aria-orientation="vertical" aria-labelledby="main-menu">
            <div class="px-2 pt-2 pb-3 space-y-1" role="none">
                <a href="/"
                   class="block px-3 py-2 rounded-md text-base font-medium text-black hover:text-blue-400"
                   role="menuitem">Home</a>
                @foreach($headerLinks as $headerLink)
                    <a href="{{ route('page', $headerLink->slug) }}"
                       class="block px-3 py-2 rounded-md text-base font-medium text-black hover:text-blue-400"
                       role="menuitem">{{ $headerLink->title }}</a>
                @endforeach
                <a href="{{ route('contact') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium text-black hover:text-blue-400"
                   role="menuitem">Contact Us</a>
            </div>
        </div>
    </div>
</div>
