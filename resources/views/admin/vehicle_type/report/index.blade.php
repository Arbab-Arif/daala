<x-dashboard-layout>
    <x-slot name="styles">
        @livewireStyles
    </x-slot>
    <x-slot name="title">
        Daala - Vehicle Type Report
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Vehicle Type Report</a>
        </div>
    </x-slot>
    @livewire('vehicle-type-report')
    <x-slot name="scripts">
        @livewireScripts
    </x-slot>
</x-dashboard-layout>

