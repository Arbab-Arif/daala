<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Commercial Type List
        </h2>
        <h2 class="text-right font-medium">
            <button type="submit" wire:click="commercialTypeExport()" class="button bg-theme-1 text-white mt-5 m-2">Export</button>
            <a href="{{ route('admin.vehicle_type.create') }}">
                <button type="submit" class="button bg-theme-1 text-white mt-5">Add</button>
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
                                           placeholder="Search By Every Thing"
                                           minlength="2">
                                </div>
                            </div>
                            @if(count($vehicleTypes) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Vehicle Type</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Vehicle Category</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Base Fare</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Per Km</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Distance</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Status</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vehicleTypes as $key => $vehicleType)
                                        <tr id="tr_{{$vehicleType->id}}">
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($vehicleType->vehicleCategory)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->base_fare }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->per_km }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $vehicleType->base_distance }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                <input data-target="#basic-select"
                                                       {{ ($vehicleType->status) ? 'checked' : null }}
                                                       class="show-code input input--switch border"
                                                       onclick="updateStatusVehicleType({{ $vehicleType->id }})" type="checkbox">
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                <a href="{{ route('admin.vehicle_type.edit', $vehicleType->id) }}">
                                                    <button type="submit" class="button bg-blue-600 text-white">Edit
                                                    </button>
                                                </a>
                                            <!--                                                <button type="button" onclick="deleteVehicleType({{ $vehicleType->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </button>-->
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($vehicleTypes->total() > $vehicleTypes->perPage())
                                    {{ $vehicleTypes->links() }}
                                @else
                                    Showing {{ $vehicleTypes->firstItem() }} to {{ $vehicleTypes->lastItem() }} out of {{ $vehicleTypes->total() }}
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
