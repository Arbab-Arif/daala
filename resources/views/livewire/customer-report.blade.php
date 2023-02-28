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
                        <div class="w-1/4 pl-4">
                            <label for="userId">Customer:</label>
                            <select name="userId" wire:model="userId" id="userId"
                                    class="cols-3 input w-full border mt-2 form-control">
                                <option value="">Select Customer</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                    <h2 class="text-right font-medium">
                        <button type="submit" wire:click="customerReportExcel()"
                                class="button bg-theme-1 text-white mt-5">Excel
                        </button>
                    </h2>
                    <div class="preview">
                        <div class="overflow-x-auto">
                            @if(count($reports) > 0)
                            <div class="flex flex-wrap px-3  mb-3">
                                <div class="w-full md:w-full">
                                    <label>Search:</label>
                                    <input type="text" wire:model="search" name="search" id="search"
                                           class="cols-3 input w-full border mt-2 form-control"
                                           placeholder="Search By Every Thing" minlength="2">
                                </div>
                            </div>
                            <table class="table scrollable">
                                <thead>
                                <tr>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">S.No</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Customer Name</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Email</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Content No #</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Address</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Postal Code</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Country</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">City</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Area</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $key => $report)
                                    <tr>
                                        <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                        <td class="border-b whitespace-no-wrap">{{ optional($report->user)->name ?? 'N/A' }}</td>
                                        <td class="border-b whitespace-no-wrap">{{ optional($report->user)->email ?? 'N/A'}}</td>
                                        <td class="border-b whitespace-no-wrap">{{ optional($report->user)->phone ?? 'N/A' }}</td>
                                        <td class="border-b whitespace-no-wrap">{{ optional($report->user)->address ?? 'N/A' }}</td>
                                        <td class="border-b whitespace-no-wrap">{{ optional($report->user)->postal_code ?? 'N/A' }}</td>
                                        <td class="border-b whitespace-no-wrap">{{ optional($report->user)->country->title ?? 'N/A' }}</td>
                                        <td class="border-b whitespace-no-wrap">{{ optional($report->user)->city->title ?? 'N/A' }}</td>
                                        <td class="border-b whitespace-no-wrap">{{ optional($report->user)->area->title ?? 'N/A' }}</td>
                                    @endforeach
                                    </tr>
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
