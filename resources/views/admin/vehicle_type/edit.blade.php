<x-dashboard-layout>
    <x-slot name="title">
        Daala - Commercial Type Edit
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.vehicle_type.index') }}" class="breadcrumb--active">  Commercial Type</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Edit</a>
        </div>
    </x-slot>
    <div id="backend-app">
        <vehicle-type-edit
            :vehicle_type="{{ $vehicleType->toJson() }}"
            :items="{{ $areaItems->toJson() }}"
            :category="{{ $vehicleCategory->toJson() }}">
        </vehicle-type-edit>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('backend/js/backend.js') }}"></script>
    </x-slot>
</x-dashboard-layout>
