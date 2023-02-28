<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Driver List
        </h2>
        <h2 class="text-right font-medium">
            <button type="submit" wire:click="driverExport()" class="button bg-theme-1 text-white mt-5 m-2">Export
            </button>
            <a href="{{ route('admin.driver.create') }}">
                <button type="submit" class="button bg-theme-1 text-white mt-5">Create</button>
            </a>
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div class="flex flex-wrap">
                                <div class="w-full md:w-full">
                                    <label>Search:</label>
                                    <input type="text" wire:model="search" name="search" id="search"
                                           class="cols-3 input w-full border mt-2 form-control"
                                           placeholder="Search By Name, Email, Mobile"
                                           minlength="2">
                                </div>
                            </div>
                            @if(count($drivers) > 0)
                                <button class="button bg-theme-1 text-white mt-5 m-2 delete_all"
                                        data-url="{{ route('admin.driver.delete.all') }}">Delete All Selected
                                </button>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                            <input type="checkbox" id="selectBox" class="mr-2">Select All
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Email</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Mobile</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Rides</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Revenue</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Status</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($drivers as $key => $driver)
                                        <tr id="tr_{{$driver->id}}">
                                            <td class="border-b"><input type="checkbox" class="sub_chk" data-id="{{$driver->id}}"></td>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{$driver->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $driver->email }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $driver->phone }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $driver->userRequest->count() }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $driver->revenue }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                <input data-target="#basic-select"
                                                       {{ ($driver->status) ? 'checked' : null }}
                                                       class="show-code input input--switch border"
                                                       onclick="updateStatusDriver({{ $driver->id }})" type="checkbox">
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                <a href="{{ route('admin.driver.edit', $driver->id) }}">
                                                    <button type="submit" class="button bg-blue-600 text-white">Edit
                                                    </button>
                                                </a>
                                                <button type="button"
                                                        onclick="deleteDriver({{ $driver->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($drivers->total() > $drivers->perPage())
                                    {{ $drivers->links() }}
                                @else
                                    Showing {{ $drivers->firstItem() }} to {{ $drivers->lastItem() }} out of {{ $drivers->total() }} results
                                @endif
                            @else
                                <div
                                    class="bg-red-100 border border-red-400 text-red-700 py-3 px-5 rounded relative mt-3"
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
