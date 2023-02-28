<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="overflow-x-auto">
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
                            <div class="flex flex-wrap">
                                <div class="w-full md:w-full">
                                    <label>Search:</label>
                                    <input type="text" wire:model="search" name="search" id="search"
                                           class="cols-3 input w-full border mt-2 form-control"
                                           placeholder="Search By Every Thing"
                                           minlength="2">
                                </div>
                            </div>
                            <h2 class="text-right font-medium">
                                <button type="submit" wire:click="revenueBreakDownReportExcel()"
                                        class="button bg-theme-1 text-white mt-5">Excel
                                </button>
                            </h2>
                            @if(count($userRequestReports) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5">S.No</th>
                                        <th class="border-b-2 dark:border-dark-5">Date</th>
                                        <th class="border-b-2 dark:border-dark-5">Time</th>
                                        <th class="border-b-2 dark:border-dark-5">Vehicle Type</th>
                                        <th class="border-b-2 dark:border-dark-5">Vehicle Category</th>
                                        <th class="border-b-2 dark:border-dark-5">Driver Name</th>
                                        <th class="border-b-2 dark:border-dark-5">Distance</th>
                                        <th class="border-b-2 dark:border-dark-5">Registration No #</th>
                                        <th class="border-b-2 dark:border-dark-5">License No #</th>
                                        <th class="border-b-2 dark:border-dark-5">Revenue</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userRequestReports as $key => $userRequest)
                                        <tr>
                                            <td class="border-b">{{ $key +1 }}</td>
                                            <td class="border-b">{{ optional($userRequest->vehicleType)->created_at ?? 'N/A' }}</td>
                                            <td class="border-b">{{ formatDuration($userRequest->started_at->diffInMinutes($userRequest->finished_at)) }}</td>
                                            <td class="border-b">{{ optional($userRequest->vehicleType)->name ?? 'N/A' }}</td>
                                            <td class="border-b">{{ optional($userRequest->vehicleType)->vehicleCategory->name ?? 'N/A' }} </td>
                                            <td class="border-b">{{ optional($userRequest->driver)->name ?? 'N/A'}}</td>
                                            <td class="border-b">{{ $userRequest->distance }}</td>
                                            <td class="border-b">{{ optional($userRequest->driver)->vehicle->vehicle_no ?? 'N/A' }}</td>
                                            <td class="border-b">{{ optional($userRequest->driver)->vehicle->license_no ?? 'N/A' }}</td>
                                            <td class="border-b">{{ optional($userRequest->vehicleType)->revenue ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($userRequestReports->total() > $userRequestReports->perPage())
                                    {{ $userRequestReports->links() }}
                                @else
                                    Showing {{ $userRequestReports->firstItem() }} to {{ $userRequestReports->lastItem() }} out of {{ $userRequestReports->total() }}
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
