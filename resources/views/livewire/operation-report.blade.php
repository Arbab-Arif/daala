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
                        <div class="w-1/4 mt-4">
                            <label for="userId">User:</label>
                            <select name="userId" wire:model="userId" id="userId"
                                    class="cols-3 input w-full border mt-2 form-control">
                                <option value="">Select Vehicle Category</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/4 mt-4 pl-4">
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
                    <div class="w-full md:w-full">
                        <label>Search:</label>
                        <input type="text" wire:model="search" name="search" id="search"
                               class="cols-3 input w-full border mt-2 form-control"
                               placeholder="Search By Every Thing"
                               minlength="2">
                    </div>
                    <h2 class="text-right font-medium">
                        <button type="submit" wire:click="operationReportExcel()"
                                class="button bg-theme-1 text-white mt-5">Excel
                        </button>
                    </h2>
                    <div class="preview">
                        <div class="overflow-x-auto">
                            @if(count($reports) > 0)
                                <table class="table scrollable">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">S.No</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Date</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Pick Up</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drop Off 1</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drop Off 2</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drop Off 3</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drop Off 4</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drop Off 5</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Driver</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">No Of Labour #</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Customer</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Revenue</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Job Status</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Job Amount</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Driver Amount</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Revenue
                                            Percentage(%)
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $canceledJobs = 0 @endphp
                                    @foreach($reports as $key => $report)
                                        @php
                                            if($report->status === 'CANCELED'){
                                                $canceledJobs += 1;
                                            }
                                            $revenue = $report->amount*15/100;
                                            $driverAmount = $report->amount - $revenue;
                                        @endphp
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->created_at }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->start_address }}</td>
                                            @foreach($report->dropOffs as $dropOff)
                                                <td class="border-b whitespace-no-wrap">{{ $dropOff->end_address }}</td>
                                            @endforeach
                                            @php
                                                $array = range(0, 5 - $report->dropOffs->count());
                                                unset($array[0]);
                                            @endphp
                                            @foreach($array as $n)
                                                <td class="border-b whitespace-no-wrap"></td>
                                            @endforeach
                                            <td class="border-b whitespace-no-wrap">{{ optional($report->driver)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ 2 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($report->user)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $revenue }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->status }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->amount }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $driverAmount }}</td>
                                            <td class="border-b whitespace-no-wrap">15%</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="border-b whitespace-no-wrap">Canceled Jobs</td>
                                        <td class="border-b whitespace-no-wrap">{{ $canceledJobs }}</td>
                                        <td class="border-b whitespace-no-wrap"></td>
                                        <td class="border-b whitespace-no-wrap"></td>
                                        <td class="border-b whitespace-no-wrap"></td>
                                        <td class="border-b whitespace-no-wrap"></td>
                                        <td class="border-b whitespace-no-wrap"></td>
                                        <td class="border-b whitespace-no-wrap"></td>
                                        <td class="border-b whitespace-no-wrap"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                {{ $reports->links() }}
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
