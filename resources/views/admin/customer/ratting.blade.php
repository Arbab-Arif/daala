<x-dashboard-layout>

    <x-slot name="title">
        Daala - Customer Rating Listing
    </x-slot>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Customer Rating</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Customer Rating List
            </h2>
            <button type="submit" wire:click="sampleDownload()" class="button bg-theme-1 text-white mt-5 m-2">Export</button>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="overflow-x-auto">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Rating</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Customer</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Driver</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">comment</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Review</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="border-b whitespace-no-wrap">1</td>
                                        <td class="border-b whitespace-no-wrap flex">
                                            @foreach(range(1, 5) as $n)
                                            <i data-feather="star"></i>
                                                @endforeach
                                        </td>
                                        <td class="border-b whitespace-no-wrap">Haris</td>
                                        <td class="border-b whitespace-no-wrap">Ahad</td>
                                        <td class="border-b whitespace-no-wrap">Best Ride</td>
                                        <td class="border-b whitespace-no-wrap">This Is Good</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b whitespace-no-wrap">2</td>
                                        <td class="border-b whitespace-no-wrap flex">
                                            @foreach(range(1, 4) as $n)
                                                <i data-feather="star"></i>
                                            @endforeach
                                        </td>
                                        <td class="border-b whitespace-no-wrap">Bilal</td>
                                        <td class="border-b whitespace-no-wrap">Ahmed</td>
                                        <td class="border-b whitespace-no-wrap">Best Ride</td>
                                        <td class="border-b whitespace-no-wrap">Its Normal</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b whitespace-no-wrap">3</td>
                                        <td class="border-b whitespace-no-wrap flex">
                                            @foreach(range(1, 3) as $n)
                                                <i data-feather="star"></i>
                                            @endforeach
                                        </td>

                                        <td class="border-b whitespace-no-wrap">Ahmed</td>
                                        <td class="border-b whitespace-no-wrap">Haris</td>
                                        <td class="border-b whitespace-no-wrap">Best Ride</td>
                                        <td class="border-b whitespace-no-wrap">Hello</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
