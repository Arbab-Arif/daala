<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Vehicle List
        </h2>
        <h2 class="text-right font-medium">
            <a href="{{ route('admin.vehicle.create') }}">
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
                            <div class="flex flex-wrap px-3  mb-3">
                                <div class="w-full md:w-full">
                                    <label>Search:</label>
                                    <input type="text" wire:model="search" name="search" id="search"
                                           class="cols-3 input w-full border mt-2 form-control"
                                           placeholder="Search By Name"
                                           minlength="2">
                                </div>
                            </div>
                            @if(count($vehicles) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Vehicle Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Make</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Model</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Year</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Status</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vehicles as $key => $vehicle)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicle->vehicle_name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicle->make }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicle->model }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicle->year }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                <input data-target="#basic-select"
                                                       {{ ($vehicle->status) ? 'checked' : null }}
                                                       class="show-code input input--switch border"
                                                       onclick="updateStatusVehicle({{ $vehicle->id }})" type="checkbox">
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                <a href="{{ route('admin.vehicle.edit', $vehicle->id) }}">
                                                    <button type="submit" class="button bg-blue-600 text-white">Edit
                                                    </button>
                                                </a>
                                                <button type="button" onclick="deleteVehicle({{ $vehicle->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($vehicles->total() > $vehicles->perPage())
                                    {{ $vehicles->links() }}
                                @else
                                    Showing {{ $vehicles->firstItem() }} to {{ $vehicles->lastItem() }} out of {{ $vehicles->total() }}
                                    results
                                @endif
                            @else
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                     role="alert">
                                    <strong class="font-bold">Hey Bro!</strong>
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
