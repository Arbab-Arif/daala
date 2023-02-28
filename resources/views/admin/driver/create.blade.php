<x-dashboard-layout>
    <x-slot name="title">
        Daala - Driver Create
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.driver.index') }}" class="breadcrumb--active">  Driver</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Create</a>
        </div>
    </x-slot>
    <div id="backend-app">
        <driver-add
            :vehicle-type="{{ $vehicleTypes->toJson() }}"
            :countries="{{ $countries->toJson() }}"
            :cities="{{ $cities->toJson() }}"
            :areas="{{ $areas->toJson() }}">
        </driver-add>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('backend/js/backend.js') }}"></script>
    </x-slot>
</x-dashboard-layout>
