<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Customer List
        </h2>
        <h2 class="text-right font-medium">
            <a href="{{ route('admin.coupon.create') }}">
                <button type="button" class="button bg-theme-1 text-white mt-5">Create</button>
            </a>
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
                                   placeholder="Search By Title, Code, Discount, Type"
                                   minlength="2">
                        </div>
                    </div>
                    <button class="button bg-theme-1 text-white mt-5 m-2 delete_all"
                            data-url="{{ route('admin.coupon.delete.all') }}">Delete All Selected
                    </button>
                    <div class="preview">
                        <div class="overflow-x-auto">
                            @if(count($coupons) > 0)
                                <table class="table scrollable">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                            <input type="checkbox" id="selectBox" class="mr-2">Select All
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Title</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Code</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Discount</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Discount Type
                                        </th>
                                        <!--                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Status</th>-->
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $key => $coupon)
                                        <tr id="tr_{{$coupon->id}}">
                                            <td class="border-b"><input type="checkbox" class="sub_chk"
                                                                        data-id="{{$coupon->id}}"></td>
                                            <td class="border-b whitespace-no-wrap">{{$key + 1}}</td>
                                            <td class="border-b whitespace-no-wrap">{{$coupon->title}}</td>
                                            <td class="border-b whitespace-no-wrap">{{$coupon->code}}</td>
                                            <td class="border-b whitespace-no-wrap">{{$coupon->value }}</td>
                                            <td class="border-b whitespace-no-wrap">{{$coupon->type }}</td>
                                            <!--                                            <td class="border-b whitespace-no-wrap">
                                                                                            <input data-target="#basic-select"
                                                                                                   class="show-code input input&#45;&#45;switch border" type="checkbox">
                                                                                        </td>-->
                                            <td class="border-b whitespace-no-wrap">
                                                <a href="{{ route('admin.coupon.edit', $coupon->id) }}">
                                                    <button type="submit" class="button bg-blue-600 text-white">Edit
                                                    </button>
                                                </a>
                                                <button type="button"
                                                        onclick="deleteCoupon({{ $coupon->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($coupons->total() > $coupons->perPage())
                                    {{ $coupons->links() }}
                                @else
                                    Showing {{ $coupons->firstItem() }} to {{ $coupons->lastItem() }} out
                                    of {{ $coupons->total() }}
                                    results
                                @endif
                            @else
                                <div
                                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-3"
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
