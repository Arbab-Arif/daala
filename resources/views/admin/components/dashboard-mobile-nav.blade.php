<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <x-logo width="80" height="34"></x-logo>
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                                                            class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{route('admin.dashboard')}}" class="menu menu--active">
                <div class="menu__icon"><i data-feather="home"></i></div>
                <div class="menu__title"> Dashboard</div>
            </a>
        </li>
        @if(auth('admin')->user()->can('item_management'))
            <li>
                <a href="{{ route('admin.item.index') }}"
                   class="menu {{ request()->routeIs('admin.item.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title">Item</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('vehicle_type_management'))
            <li>
                <a href="{{ route('admin.vehicle_type.index') }}"
                   class="menu {{ request()->routeIs('admin.vehicle_type.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title"> Commercial Type</div>
                </a>
            </li>
        @endif

        @if(auth('admin')->user()->can('driver_management'))
            <li>
                <a href="{{ route('admin.driver.index') }}"
                   class="menu {{ request()->routeIs('admin.driver.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title"> Driver</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('customer_management'))
            <li>
                <a href="{{ route('admin.customer.index') }}"
                   class="menu {{ request()->routeIs('admin.customer.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="users"></i></div>
                    <div class="menu__title"> Customer</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('customer_review_management'))
            <li>
                <a href="{{ route('admin.rating.index') }}"
                   class="menu {{ request()->routeIs('admin.rating.*') ? 'side-menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title"> Customer Review</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('user_request_management'))
            <li>
                <a href="{{ route('admin.job.index') }}"
                   class="menu {{ request()->routeIs('admin.job.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title">Bookings</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('setting_management'))
            <li>
                <a href="{{route('admin.setting.create')}}"
                   class="menu {{ request()->routeIs('admin.setting.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title">Settings</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('role_management'))
            <li>
                <a href="{{ route('admin.role.index') }}"
                   class="menu {{ request()->routeIs('admin.role.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title"> Roles</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin_management'))
        <li>
            <a href="{{ route('admin.sub_admin.index') }}"
               class="menu {{ request()->routeIs('admin.sub_admin.*') ? 'menu--active' : null }}">
                <div class="menu__icon"><i data-feather="file-text"></i></div>
                <div class="menu__title"> Sub Admin</div>
            </a>
        </li>
        @endif
        @if(auth('admin')->user()->can('page_management'))
            <li>
                <a href="{{ route('admin.page.index') }}"
                   class="menu {{ request()->routeIs('admin.page.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title"> Pages</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('slider_management'))
            <li>
                <a href="{{ route('admin.slider.index') }}"
                   class="menu {{ request()->routeIs('admin.slider.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title"> Sliders</div>
                </a>
            </li>
        @endif
       {{-- @if(auth('admin')->user()->can('banner_management'))
            <li>
                <a href="{{ route('admin.banner.create') }}"
                   class="menu {{ request()->routeIs('admin.banner.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title"> Banner</div>
                </a>
            </li>
        @endif--}}
        @if(auth('admin')->user()->can('area_management'))
            <li>
                <a href="{{ route('admin.area.create') }}"
                   class="menu {{ request()->routeIs('admin.area.*') ? 'menu--active' : null }}">
                    <div class="menu__icon"><i data-feather="file-text"></i></div>
                    <div class="menu__title">Area</div>
                </a>
            </li>
        @endif
    </ul>
</div>
