<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        {{--        <img class="w-6" src="{{ asset('backend/images/logo.svg') }}">--}}
        <span class="hidden xl:block text-white text-lg ml-3">
           <x-logo width="120" height="54"></x-logo>
        </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{route('admin.dashboard')}}"
               class="side-menu {{ request()->routeIs('admin.dashboard') ? 'side-menu--active' : null }}">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title"> Dashboard</div>
            </a>
        </li>
        @if(auth('admin')->user()->can('item_management'))
            <li>
                <a href="{{ route('admin.item.index') }}"
                   class="side-menu {{ request()->routeIs('admin.item.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="file-text"></i></div>
                    <div class="side-menu__title"> Item</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('vehicle_type_management'))
            <li>
                <a href="{{ route('admin.vehicle_type.index') }}"
                   class="side-menu {{ request()->routeIs('admin.vehicle_type.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="inbox"></i></div>
                    <div class="side-menu__title"> Commercial Type</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('coupon_management'))
            <li>
                <a href="{{ route('admin.coupon.index') }}"
                   class="side-menu {{ request()->routeIs('admin.coupon.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="credit-card"></i></div>
                    <div class="side-menu__title"> Coupon</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('driver_management'))
            <li>
                <a href="{{ route('admin.driver.index') }}"
                   class="side-menu {{ request()->routeIs('admin.driver.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Driver</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('customer_management'))
            <li>
                <a href="{{ route('admin.customer.index') }}"
                   class="side-menu {{ request()->routeIs('admin.customer.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="users"></i></div>
                    <div class="side-menu__title"> Customer</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('customer_review_management'))
            <li>
                <a href="{{ route('admin.rating.index') }}"
                   class="side-menu {{ request()->routeIs('admin.rating.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="thumbs-up"></i></div>
                    <div class="side-menu__title"> Customer Review</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('customer_feedback_management'))
            <li>
                <a href="{{ route('admin.feedback.index') }}"
                   class="side-menu {{ request()->routeIs('admin.feedback.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="thumbs-up"></i></div>
                    <div class="side-menu__title"> Customer Feedback</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('contact_management'))
            <li>
                <a href="{{ route('admin.contact.index') }}"
                   class="side-menu {{ request()->routeIs('admin.contact.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="thumbs-up"></i></div>
                    <div class="side-menu__title"> Contact Us</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('user_request_management'))
            <li>
                <a href="{{route('admin.job.index')}}"
                   class="side-menu {{ request()->routeIs('admin.job.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="briefcase"></i></div>
                    <div class="side-menu__title"> Jobs</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('setting_management'))
            <li>
                <a href="{{route('admin.setting.create')}}"
                   class="side-menu {{ request()->routeIs('admin.setting.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="tool"></i></div>
                    <div class="side-menu__title">Settings</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('role_management'))
            <li>
                <a href="{{ route('admin.role.index') }}"
                   class="side-menu {{ request()->routeIs('admin.role.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="file-text"></i></div>
                    <div class="side-menu__title"> Roles</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('admin_management'))
            <li>
                <a href="{{ route('admin.sub_admin.index') }}"
                   class="side-menu {{ request()->routeIs('admin.sub_admin.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="file-text"></i></div>
                    <div class="side-menu__title">User Management</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('page_management'))
            <li>
                <a href="{{ route('admin.page.index') }}"
                   class="side-menu {{ request()->routeIs('admin.page.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="layout"></i></div>
                    <div class="side-menu__title"> Pages</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('slider_management'))
            <li>
                <a href="{{ route('admin.slider.index') }}"
                   class="side-menu {{ request()->routeIs('admin.slider.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="sliders"></i></div>
                    <div class="side-menu__title"> Slider</div>
                </a>
            </li>
        @endif
        {{-- @if(auth('admin')->user()->can('banner_management'))
             <li>
                 <a href="{{ route('admin.banner.create') }}"
                    class="side-menu {{ request()->routeIs('admin.banner.*') ? 'side-menu--active' : null }}">
                     <div class="side-menu__icon"><i data-feather="file-text"></i></div>
                     <div class="side-menu__title"> Banner</div>
                 </a>
             </li>
         @endif--}}
        @if(auth('admin')->user()->can('area_management'))
            <li>
                <a href="{{ route('admin.area.index') }}"
                   class="side-menu {{ request()->routeIs('admin.area.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="file-text"></i></div>
                    <div class="side-menu__title">Area</div>
                </a>
            </li>
        @endif
        @if(auth('admin')->user()->can('reports_management'))
            <li>
                <a href="javascript:void(0)" class="side-menu">
                    <div class="side-menu__icon"><i data-feather="file-text"></i></div>
                    <div class="side-menu__title"> Reports
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-down side-menu__sub-icon">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="" style="display: none;">
                    <li>
                        <a href="{{ route('admin.report.vehicle.type') }}" class="side-menu">
                            <div class="side-menu__icon"></div>
                            <div class="side-menu__title"> Vehicle Type</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.report.revenue.breakdown') }}" class="side-menu">
                            <div class="side-menu__icon"></div>
                            <div class="side-menu__title"> Revenue Break Down</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.report.operation') }}" class="side-menu">
                            <div class="side-menu__icon"></div>
                            <div class="side-menu__title"> Operation</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.report.customer') }}" class="side-menu">
                            <div class="side-menu__icon"></div>
                            <div class="side-menu__title"> Customer</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.report.driver') }}" class="side-menu">
                            <div class="side-menu__icon"></div>
                            <div class="side-menu__title"> Driver</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

    </ul>
</nav>
