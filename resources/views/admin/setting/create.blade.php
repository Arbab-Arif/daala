<x-dashboard-layout>
    <x-slot name="title">
        Daala - Setting
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="#" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Setting</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Setting
            </h2>
        </div>
    </div>
    <div id="backend-app">
    <setting-add :setting="{{$setting->toJson()}}"></setting-add>
    </div>
    <x-slot name="scripts">
        <script src="{{asset('backend/js/backend.js')}}"></script>
    </x-slot>
</x-dashboard-layout>
