<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Customer FeedBack List
        </h2>
{{--        <h2 class="text-right font-medium">--}}
{{--            <button type="submit" wire:click="customerExport()" class="button bg-theme-1 text-white mt-5 m-2">Export</button>--}}
{{--            <a href="{{ route('admin.customer.create') }}">--}}
{{--                <button type="button" class="button bg-theme-1 text-white mt-5">Create</button>--}}
{{--            </a>--}}
{{--        </h2>--}}
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
                                   placeholder="Search By Name, Email, Phone, Address"
                                   minlength="2">
                        </div>
                    </div>
{{--                    <button class="button bg-theme-1 text-white mt-5 m-2 delete_all"--}}
{{--                            data-url="{{ route('admin.customer.delete.all') }}">Delete All Selected--}}
{{--                    </button>--}}
                    <div class="preview">
                        <div class="overflow-x-auto">
                            @if(count($customerFeedBacks) > 0)
                                <table class="table scrollable">
                                    <thead>
                                    <tr>
{{--                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">--}}
{{--                                            <input type="checkbox" id="selectBox" class="mr-2">Select All--}}
{{--                                        </th>--}}
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Customer Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Suggestion</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customerFeedBacks as $key => $customer)
                                        <tr id="tr_{{$customer->id}}">
{{--                                            <td class="border-b"><input type="checkbox" class="sub_chk" data-id="{{$customer->id}}"></td>--}}
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($customer->user)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $customer->suggestion }}</td>
                                            <td class="border-b whitespace-no-wrap">
{{--                                                <a href="{{ route('admin.customer.edit', $customer->id) }}">--}}
{{--                                                    <button type="submit" class="button bg-blue-600 text-white">Edit--}}
{{--                                                    </button>--}}
{{--                                                </a>--}}
                                                <button type="button" onclick="deleteCustomerFeedBack({{ $customer->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($customerFeedBacks->total() > $customerFeedBacks->perPage())
                                    {{ $customerFeedBacks->links() }}
                                @else
                                    Showing {{ $customerFeedBacks->firstItem() }} to {{ $customerFeedBacks->lastItem() }} out of {{ $customerFeedBacks->total() }}
                                    results
                                @endif
                            @else
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-3"
                                     role="alert">
                                    <span class="block sm:inline">There Is No Record Found.</span>
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
