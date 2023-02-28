<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @if(Request::get('status') === 'COMPLETED')
                Completed Job List
            @elseif(Request::get('status') === 'CANCELED')
                Canceled Job List
            @elseif(Request::get('status') === 'ONGOING')
                Ongoing Job List
            @elseif(Request::get('status') === 'SCHEDULED')
                Scheduled Job List
            @else
                Total Job List
            @endif

        </h2>
        <h2 class="text-right font-medium">
            <form method="post" action="{{ route('admin.job.export') }}">
                @csrf
                <input type="hidden" name="data" value="{{ $bookings->toJson() }}">
                <button type="submit" class="button bg-theme-1 text-white mt-5">Export</button>
            </form>
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="flex flex-wrap px-3  mb-3">
                        <div class="w-full md:w-full">
                            <label>Search:</label>
                            <input type="text" wire:model="search" name="search" id="search"
                                   class="cols-3 input w-full border mt-2 form-control"
                                   placeholder="Search By Everything"
                                   minlength="2">
                        </div>
                    </div>
                    <div class="preview">
                        <div class="overflow-x-auto">
                            @if ($bookings->count())
                                <table class="table scrollable">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5">#</th>
                                        <th class="border-b-2 dark:border-dark-5">Date</th>
                                        <th class="border-b-2 dark:border-dark-5">Job Id</th>
                                        <th class="border-b-2 dark:border-dark-5">Pick Up</th>
                                        <th class="border-b-2 dark:border-dark-5">Drop Off 1</th>
                                        <th class="border-b-2 dark:border-dark-5">Drop Off 2</th>
                                        <th class="border-b-2 dark:border-dark-5">Drop Off 3</th>
                                        <th class="border-b-2 dark:border-dark-5">Drop Off 4</th>
                                        <th class="border-b-2 dark:border-dark-5">Drop Off 5</th>
                                        <th class="border-b-2 dark:border-dark-5">Driver Name</th>
                                        <th class="border-b-2 dark:border-dark-5">Customer Name</th>
                                        <th class="border-b-2 dark:border-dark-5">Vehicle Type</th>
                                        <th class="border-b-2 dark:border-dark-5">Number of Labour</th>
                                        <th class="border-b-2 dark:border-dark-5">Labour Charges</th>
                                        @if(Request::get('status') === 'ONGOING')
                                            <th class="border-b-2 dark:border-dark-5">Estimated Amount</th>
                                            <th class="border-b-2 dark:border-dark-5">Status</th>
                                        @elseif(Request::get('status') === 'SCHEDULED')
                                            <th class="border-b-2 dark:border-dark-5">Scheduled Date</th>
                                            <th class="border-b-2 dark:border-dark-5">Estimated Amount</th>
                                            <th class="border-b-2 dark:border-dark-5">Status</th>
                                        @elseif(Request::get('status') === 'COMPLETED')
                                            <th class="border-b-2 dark:border-dark-5">Payment of Ride</th>
                                            <th class="border-b-2 dark:border-dark-5">Payment of Labour</th>
                                            <th class="border-b-2 dark:border-dark-5">Total Amount</th>
                                        @elseif(Request::get('status') === 'CANCELED')
                                            <th class="border-b-2 dark:border-dark-5">Penalty</th>
                                            <th class="border-b-2 dark:border-dark-5">Reason</th>
                                        @else
                                            <th class="border-b-2 dark:border-dark-5">Payment of Ride</th>
                                            <th class="border-b-2 dark:border-dark-5">Status</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bookings as $key => $booking)
                                        <tr>
                                            <td class="border-b">{{ $key +1 }}</td>
                                            <td class="border-b">{{ $booking->created_at }}</td>
                                            <td class="border-b">{{ $booking->booking_id }}</td>
                                            <td class="border-b">{{ $booking->start_address }}</td>
                                            @foreach($booking->dropOffs as $dropOff)
                                                <td class="border-b whitespace-no-wrap">{{ $dropOff->address }}</td>
                                            @endforeach
                                            @php
                                                $array = range(0, 5 - $booking->dropOffs->count());
                                                unset($array[0]);
                                            @endphp
                                            @foreach($array as $n)
                                                <td class="border-b whitespace-no-wrap"></td>
                                            @endforeach
                                            <td class="border-b">{{ optional($booking->driver)->name ?? 'N/A' }}</td>
                                            <td class="border-b">{{ optional($booking->user)->name ?? 'N/A' }}</td>
                                            <td class="border-b">{{ optional($booking->vehicleType)->name ?? 'N/A' }}</td>
                                            <td class="border-b">{{ $booking->no_of_labour }}</td>
                                            <td class="border-b">{{ $labourCharges*$booking->no_of_labour }}</td>
                                            @if(Request::get('status') === 'ONGOING')
                                                <td class="border-b">{{ $booking->amount }}</td>
                                                <td class="border-b">{{ $booking->status }}</td>
                                            @elseif(Request::get('status') === 'SCHEDULED')
                                                <td class="border-b">{{ $booking->created_at }}</td>
                                                <td class="border-b">{{ $booking->amount }}</td>
                                                <td class="border-b">{{ $booking->status }}</td>
                                            @elseif(Request::get('status') === 'COMPLETED')
                                                <td class="border-b whitespace-no-wrap">{{ $booking->amount }}</td>
                                                <td class="border-b whitespace-no-wrap">{{ $booking->amount }}</td>
                                                <td class="border-b whitespace-no-wrap">{{ 400 }}</td>
                                            @elseif(Request::get('status') === 'CANCELED')
                                                <td class="border-b whitespace-no-wrap">{{ $booking->amount }}</td>
                                                <td class="border-b whitespace-no-wrap">{{ $booking->amount }}</td>
                                            @else
                                                <td class="border-b whitespace-no-wrap">{{ $booking->amount }}</td>
                                                <td class="border-b whitespace-no-wrap">{{ $booking->status }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($bookings->total() > $bookings->perPage())
                                    {{ $bookings->links() }}
                                @else
                                    Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} out of {{ $bookings->total() }}
                                    results
                                @endif
                            @else
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-3"
                                     role="alert">
                                    <span class="block sm:inline">There Is No Record Found.</span>
                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
