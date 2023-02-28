<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Role Management List
        </h2>
        <h2 class="text-right font-medium">
            {{--            <button type="submit" wire:click="rolesExport()" class="button bg-theme-1 text-white mt-5 m-2">Export</button>--}}
            <a href="{{ route('admin.role.create') }}">
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
                            <div class="w-full md:w-full">
                                <label>Search:</label>
                                <input type="text" wire:model="search" name="search" id="search"
                                       class="cols-3 input w-full border mt-2 form-control"
                                       placeholder="Search By Role"
                                       minlength="2">
                            </div>
                            @if(count($roles) > 0)
                                <button class="button bg-theme-1 text-white mt-5 m-2 delete_all"
                                        data-url="{{ route('admin.role.delete.all') }}">Delete All Selected
                                </button>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                            <input type="checkbox" id="selectBox" class="mr-2">Select All
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Role</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Permissions</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $key => $role)

                                        <tr id="tr_{{$role->id}}">
                                            <td class="border-b"><input type="checkbox" class="sub_chk" data-id="{{$role->id}}"></td>
                                            <td class="border-b whitespace-no-wrap">{{ $key+1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $role->label }}</td>
                                            <td class="border-b whitespace">{{ $role->permissions->pluck('label')->implode(', ') }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                <a href="{{ route('admin.role.edit', $role->id) }}">
                                                    <button type="submit" class="button bg-blue-600 text-white">Edit
                                                    </button>
                                                </a>
                                                <button type="button" onclick="deleteRole({{ $role->id }})"
                                                        class="button bg-red-600 text-white">Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @if($roles->total() > $roles->perPage())
                                    {{ $roles->links() }}
                                @else
                                    Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} out of {{ $roles->total() }}
                                    results
                                @endif
                            @else
                                <div
                                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3"
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
