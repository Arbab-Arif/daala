<x-dashboard-layout>
    <x-slot name="title">
        Daala - Item Edit
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.item.index') }}" class="breadcrumb--active"> Item</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Edit</a>
        </div>
    </x-slot>
    <div id="backend-app">
        <item-edit :item="{{ $itemData->toJson() }}"
        :category="{{$category->toJson()}}"></item-edit>
    </div>
    <x-slot name="scripts">
        <script src="{{asset('backend/js/backend.js')}}"></script>
    </x-slot>
</x-dashboard-layout>
