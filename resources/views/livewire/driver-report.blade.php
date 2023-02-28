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
                            <label for="driverId">Driver:</label>
                            <select name="driverId" wire:model="driverId" id="driverId"
                                    class="cols-3 input w-full border mt-2 form-control">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/4 pl-4">
                            <label for="status">Status:</label>
                            <select name="status" wire:model="status" id="status"
                                    class="cols-3 input w-full border mt-2 form-control">
                                <option value="">Select Status</option>
                                <option value="PENDING">PENDING</option>
                                <option value="COMPLETED">COMPLETED</option>
                                <option value="CANCELED">CANCELED</option>
                                <option value="ONGOING">ONGOING</option>
                                <option value="SCHEDULED">SCHEDULED</option>
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
                    <div class="preview">
                        <h2 class="text-right font-medium">
                            <button type="submit" wire:click="driverReportExcel()"
                                    class="button bg-theme-1 text-white mt-5">Excel
                            </button>
                        </h2>
                        <div class="overflow-x-auto">
                            @if(count($reports) > 0)
                                <table class="table scrollable">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">S.No</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Date</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">First Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Last Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Email</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Mobile</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">CNIC</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Postal Code</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Country</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">City</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Area</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Vehicle Type</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Vehicle Category</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Vehicle No</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Total Rides</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reports as $key => $report)
                                        @php
                                            $name = $report->name;
                                         $firstname = strtok($name, ' ');
                                         $lastname = strstr($name, ' ');
                                        @endphp
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->created_at }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $firstname }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $lastname }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->email }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->phone }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->cnic }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->postal_code }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($report->country)->title ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($report->city)->title ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($report->area)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($report->vehicle->vehicle_type)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional(optional(optional($report->vehicle)->vehicle_type)->vehicleCategory)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($report->vehicle)->vehicle_no ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->userRequest->count() }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->userRequest->pluck('amount')->sum() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($reports->total() > $reports->perPage())
                                    {{ $reports->links() }}
                                @else
                                    Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} out of {{ $reports->total() }}
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
