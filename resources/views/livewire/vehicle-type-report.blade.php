<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="flex flex-wrap px-3  mb-3">
                        <div class="w-1/4">
                            <label for="form_date">From Date:</label>
                            <input type="date" wire:model="fromDate" id="form_date"
                                   class="cols-3 input w-full border mt-2 form-control">
                        </div>
                        <div class="w-1/4 pl-3">
                            <label for="to_date">To Date:</label>
                            <input type="date" wire:model="toDate" id="to_date"
                                   class="cols-3 input w-full border mt-2 form-control">
                        </div>
                        <div class="w-1/4 pl-3">
                            <label for="vehicleCategoryId">Vehicle Category:</label>
                            <select name="vehicleCategoryId" wire:model="vehicleCategoryId"
                                    id="vehicleCategoryId"
                                    class="cols-3 input w-full border mt-2 form-control">
                                <option value="">Select Vehicle Category</option>
                                @foreach($vehicleCategories as $vehicleCategory)
                                    <option
                                        value="{{ $vehicleCategory->id }}">{{ $vehicleCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/4 pl-3">
                            <label for="vehicleTypeId">Vehicle Type:</label>
                            <select name="vehicleTypeId" wire:model="vehicleTypeId" id="vehicleTypeId"
                                    class="cols-3 input w-full border mt-2 form-control">
                                <option value="">Select Vehicle Category</option>
                                @foreach($vehicleTypes as $vehicleType)
                                    <option value="{{ $vehicleType->id }}">{{ $vehicleType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-wrap px-3  mb-3">
                        <div class="w-full md:w-full">
                            <label>Search:</label>
                            <input type="text" wire:model="search" name="search" id="search"
                                   class="cols-3 input w-full border mt-2 form-control"
                                   placeholder="Search By Every Thing" minlength="2">
                        </div>
                    </div>
                    <h2 class="text-right font-medium">
                        <button type="submit" wire:click="vehicleTypeReportExcel()"
                                class="button bg-theme-1 text-white mt-5">Excel
                        </button>

                    </h2>
                    <div class="preview">
                        <div class="overflow-x-auto">
                            @if(count($vehicleTypeReports) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">S.No</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Date</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Total No Vehicles
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Vehicle Category
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Vehicle Type</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Registration No #
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">License No #</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Revenue</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vehicleTypeReports as $key => $vehicleType)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->created_at }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->vehicles->count() }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($vehicleType->vehicleCategory)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->vehicles->pluck('vehicle_no')->implode(', ') }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->vehicles->pluck('license_no')->implode(', ') }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->revenue }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($vehicleTypeReports->total() > $vehicleTypeReports->perPage())
                                    {{ $vehicleTypeReports->links() }}
                                @else
                                    Showing {{ $vehicleTypeReports->firstItem() }} to {{ $vehicleTypeReports->lastItem() }} out of {{ $vehicleTypeReports->total() }}
                                    results
                                @endif
                            @else
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                     role="alert"><span class="block sm:inline">There Is No Record Found.</span>
                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
