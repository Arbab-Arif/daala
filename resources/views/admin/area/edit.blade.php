<x-dashboard-layout>
    <x-slot name="title">
        Daala - Area Edit
    </x-slot>
    <x-slot name="styles">
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.map.key') }}&libraries=places,drawing"></script>
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.area.index') }}" class="breadcrumb--active">Area</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Edit</a>
        </div>
    </x-slot>
    <div id="backend-app">
        <area-edit :area="{{ $area->toJson() }}"></area-edit>
    </div>
    <x-slot name="scripts">
        <script src="{{asset('backend/js/backend.js')}}"></script>
    </x-slot>
</x-dashboard-layout>
