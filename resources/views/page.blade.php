<x-app title="{{ $page->title }}">
    <div id="content" style="min-height: 100vh">
        <h1 class="md:text-xl text-center my-6">{{ $page->title }}</h1>
        <div class="px-2 md:px-4 lg:px-6 mb-4">{!! $page->content !!}</div>
    </div>
</x-app>
