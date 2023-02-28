<x-dashboard-layout>
    <x-slot name="title">
        Daala - Coupon Create
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.coupon.index') }}" class="breadcrumb--active"> Coupon</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Edit</a>
        </div>
    </x-slot>
    <div id="backend-app">
        <coupon-edit :coupon="{{$coupon->toJson()}}"></coupon-edit>
    </div>
    <x-slot name="scripts">
        <script src="{{asset('backend/js/backend.js')}}"></script>
    </x-slot>
</x-dashboard-layout>
