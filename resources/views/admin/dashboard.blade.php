<x-dashboard-layout>
    <x-slot name="title">
        Daala - Dashboard
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Daala</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Dashboard</a>
        </div>
    </x-slot>
    <div class="grid grid-cols-12 gap-12">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-12">
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10 ml-2">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Operations
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.report.operation') }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5 h-40">
                                    <div class="flex">
                                        <div class="text-base text-black mt-1 ">
                                            Total # of jobs
                                        </div>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <i data-feather="shopping-cart"
                                       class="report-box__icon text-theme-10 pd-2 float-right mt-6"></i>
                                    <div class="text-3xl font-bold leading-8 mt-6 my-2">{{ $totalJobs->count() }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.report.operation', [ 'status' => 'COMPLETED'], false) }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5 h-40">
                                    <div class="flex">
                                        <div class="text-base text-black mt-1">Completed
                                            jobs
                                        </div>
                                    </div>
                                    <i data-feather="credit-card"
                                       class="report-box__icon text-theme-11 float-right mt-6"></i>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{ $completeJobs->count() }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.report.operation', [ 'status' => 'ONGOING'], false) }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5 h-40">
                                    <div class="flex">
                                        <div class="text-base text-black mt-1">On - going
                                            jobs
                                        </div>
                                    </div>
                                    <i data-feather="monitor"
                                       class="report-box__icon text-theme-12 float-right mt-6"></i>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{ $ongoingJobs->count() }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.report.operation', [ 'status' => 'SCHEDULED'], false) }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5 h-40">
                                    <div class="flex">
                                        <div class="text-base text-black mt-1"> Scheduled
                                            jobs
                                        </div>
                                    </div>
                                    <i data-feather="users" class="report-box__icon text-theme-9 float-right mt-6"></i>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{ $scheduledJobs->count() }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.report.operation', [ 'status' => 'CANCELED'], false) }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5 h-40">
                                    <div class="flex">
                                        <div class="text-base text-black mt-1">Cancelled
                                            rides
                                        </div>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <i data-feather="shopping-cart"
                                       class="report-box__icon text-theme-10 pd-2 float-right mt-6"></i>
                                    <div
                                        class="text-3xl font-bold leading-8 mt-6 my-2">{{ $canceledJobs->count() }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.report.operation') }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5 h-40">
                                    <div class="flex">
                                        <div class="text-base text-black mt-1">
                                            Revenue
                                        </div>
                                    </div>
                                    <i data-feather="monitor"
                                       class="report-box__icon text-theme-12 float-right mt-6"></i>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{ $totalJobs->sum('amount') }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-12">
                    <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-12">
                        <div class="col-span-12 mt-12">
                            <div class="intro-y flex items-center h-10 ml-2">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    User Base
                                </h2>
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <a href="{{ route('admin.report.customer') }}">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5 h-40">
                                                <div class="flex">
                                                    <div class="text-base text-black mt-1">
                                                        Registered users
                                                    </div>
                                                    <div class="ml-auto">
                                                    </div>
                                                </div>
                                                <i data-feather="shopping-cart"
                                                   class="report-box__icon text-theme-10 pd-2 float-right mt-6"></i>
                                                <div
                                                    class="text-3xl font-bold leading-8 mt-6 my-2">{{ $customerCount }}</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <a href="{{ route('admin.report.customer') }}">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5 h-40">
                                                <div class="flex">
                                                    <div class="text-base text-black mt-1"> App
                                                        Installs
                                                    </div>
                                                </div>
                                                <i data-feather="credit-card"
                                                   class="report-box__icon text-theme-11 float-right mt-6"></i>
                                                <div class="text-3xl font-bold leading-8 mt-6">0.00</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <a href="{{ route('admin.report.customer') }}">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5 h-40">
                                                <div class="flex">
                                                    <div class="text-base text-black mt-1"> Web
                                                        Traffic
                                                    </div>
                                                </div>
                                                <i data-feather="monitor"
                                                   class="report-box__icon text-theme-12 float-right mt-6"></i>
                                                <div class="text-3xl font-bold leading-8 mt-6">0</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <a href="{{ route('admin.report.customer') }}">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5 h-40">
                                                <div class="flex">
                                                    <div class="text-base text-black mt-1">
                                                        App Traffic
                                                    </div>
                                                </div>
                                                <i data-feather="users"
                                                   class="report-box__icon text-theme-9 float-right mt-6"></i>
                                                <div class="text-3xl font-bold leading-8 mt-6">0</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-12">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-12">
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10 ml-2">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Revenue Breakdown
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{ route('admin.report.revenue.breakdown') }}">
                            <div class="report-box zoom-in">
                                <div class="box p-5 h-40">
                                    <div class="flex">
                                        <div class="text-base text-black mt-1">
                                            Revenue
                                        </div>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <i data-feather="shopping-cart"
                                       class="report-box__icon text-theme-10 pd-2 float-right mt-6"></i>
                                    <div
                                        class="text-3xl font-bold leading-8 mt-6 my-2">{{ $totalJobs->sum('amount') }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @foreach($vehicleTypes as $vehicleType)
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <a href="{{ route('admin.report.revenue.breakdown', ['vehicle_type' => $vehicleType->id], false) }}">
                                <div class="report-box zoom-in">
                                    <div class="box p-5 h-40">
                                        <div class="flex">
                                            <div class="text-base text-black mt-1">
                                                {{ $vehicleType->name }}
                                            </div>
                                        </div>
                                        <i data-feather="credit-card"
                                           class="report-box__icon text-theme-11 float-right mt-6"></i>
                                        <div
                                            class="text-3xl font-bold leading-8 mt-6">{{ $vehicleType->revenue }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                <div class="grid grid-cols-12 gap-12">
                    <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-12">
                        <div class="col-span-12 mt-12">
                            <div class="intro-y flex items-center h-10 ml-2">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Daala registered
                                </h2>
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <a href="{{ route('admin.report.vehicle.type') }}">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5 h-40">
                                                <div class="flex">
                                                    <div class="text-base text-black mt-1">
                                                        Total Daala Registered
                                                    </div>
                                                    <div class="ml-auto">
                                                    </div>
                                                </div>
                                                <i data-feather="shopping-cart"
                                                   class="report-box__icon text-theme-10 pd-2 float-right mt-6"></i>
                                                <div
                                                    class="text-3xl font-bold leading-8 mt-6 my-2">{{ $driverCount }}</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @foreach($vehicleTypes as $vehicleType)
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <a href="{{ route('admin.report.vehicle.type') }}">
                                            <div class="report-box zoom-in">
                                                <div class="box p-5 h-40">
                                                    <div class="flex">
                                                        <div class="text-base text-black mt-1">
                                                            Total {{ $vehicleType->name }} Registered
                                                        </div>
                                                    </div>
                                                    <i data-feather="users"
                                                       class="report-box__icon text-theme-9 float-right mt-6"></i>
                                                    <div
                                                        class="text-3xl font-bold leading-8 mt-6">{{ $vehicleType->vehicles->count() }}</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                            </div>


                            {{--  <x-slot name="title">
                                  Daala - Driver Listing
                              </x-slot>
                              <div class="content">
                                  <div class="intro-y flex items-center mt-8">
                                      <h2 class="text-lg font-medium mr-auto">
                                      </h2>
                                      <h2 class="text-right font-medium">
                                      </h2>
                                  </div>
                                  <div class="grid grid-cols-12 gap-6 mt-5">
                                      <div class="intro-y col-span-12 lg:col-span-12">
                                          <div class="intro-y box">
                                              <div class="content">
                                                  <div class="intro-y flex items-center mt-8">
                                                      <h2 class="text-lg font-medium mr-auto">
                                                      </h2>
                                                      <h2 class="text-right font-medium">
                                                      </h2>
                                                  </div>
                                                  <div class="grid grid-cols-12 gap-6 mt-5">
                                                      <div class="intro-y col-span-12 lg:col-span-12">
                                                          <div class="intro-y box">
                                                              <div class="p-5" id="form-validation">
                                                                  <h2 class="text-lg font-medium mr-auto mb-2">
                                                                      Recent Rides
                                                                  </h2>
                                                                  <div class="preview">
                                                                      <div class="overflow-x-auto">
                                                                          <table class="table">
                                                                              <thead>
                                                                              </thead>
                                                                              <tbody>
                                                                              <tr>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      1
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      Stevens Demo
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <a href="#">View Ride Details</a>
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      51 minutes ago
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <span
                                                                                          class="text-xs  bg-blue-400 p-1 rounded-md text-white ml-auto">Completed</span>
                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      1
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      Stevens Demo
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <a href="#">View Ride Details</a>
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      51 minutes ago
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <span
                                                                                          class="text-xs  bg-blue-400 p-1 rounded-md text-white ml-auto">Completed</span>
                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      1
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      Stevens Demo
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <a href="#">View Ride Details</a>
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      51 minutes ago
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <span
                                                                                          class="text-xs  bg-blue-400 p-1 rounded-md text-white ml-auto">Completed</span>
                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      1
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      Stevens Demo
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <a href="#">View Ride Details</a>
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      51 minutes ago
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <span
                                                                                          class="text-xs  bg-blue-400 p-1 rounded-md text-white ml-auto">Completed</span>
                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      1
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      Stevens Demo
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <a href="#">View Ride Details</a>
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      51 minutes ago
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <span
                                                                                          class="text-xs bg-red-400 p-1 rounded-md text-white ml-auto">Cancel</span>
                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      1
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      Stevens Demo
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <a href="#">View Ride Details</a>
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      51 minutes ago
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <span
                                                                                          class="text-xs bg-red-400 p-1 rounded-md text-white ml-auto">Cancel</span>
                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      1
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      Stevens Demo
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <a href="#">View Ride Details</a>
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      51 minutes ago
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <span
                                                                                          class="text-xs bg-red-400 p-1 rounded-md text-white ml-auto">Cancel</span>
                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      1
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      Stevens Demo
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <a href="#">View Ride Details</a>
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      51 minutes ago
                                                                                  </td>
                                                                                  <td class="border-b whitespace-no-wrap">
                                                                                      <span
                                                                                          class="text-xs bg-red-400 p-1 rounded-md text-white ml-auto">Cancel</span>
                                                                                  </td>
                                                                              </tr>


                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script>
            function completeJobs(complete) {
                // console.log(complete);
                // wire:model="";
                Livewire.emit('completeJobs', complete);
            }
        </script>
    </x-slot>
</x-dashboard-layout>
