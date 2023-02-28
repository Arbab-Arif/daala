<x-dashboard-layout>
    <x-slot name="title">
        Daala - Commercial Type Create
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.vehicle_type.index') }}" class="breadcrumb--active">Commercial Type</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Create</a>
        </div>
    </x-slot>
    <div id="backend-app">
        <vehicle-type-add
            :default_area="{{ $areas->toJson() }}"
            :category="{{ $vehicleCategory->toJson() }}">
        </vehicle-type-add>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('backend/js/backend.js') }}"></script>
    </x-slot>
</x-dashboard-layout>
