<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Page List
        </h2>
        <h2 class="text-right font-medium">
            <a href="{{ route('admin.page.create') }}">
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
                                           placeholder="Search By Title And Type"
                                           minlength="2">
                                </div>
                            </div>
                            @if(count($pages) > 0)
                                <button class="button bg-theme-1 text-white mt-5 m-2 delete_all"
                                        data-url="{{ route('admin.page.delete.all') }}">Delete All Selected
                                </button>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                            <input type="checkbox" id="selectBox" class="mr-2">Select All
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Title</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Type</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pages as $key => $page)
                                        <tr id="tr_{{$page->id}}">
                                            <td class="border-b"><input type="checkbox" class="sub_chk" data-id="{{$page->id}}"></td>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $page->title }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $page->type }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                <a href="{{ route('admin.page.edit', $page->id) }}">
                                                    <button type="submit" class="button bg-blue-600 text-white">Edit
                                                    </button>
                                                </a>
                                                <button type="button" onclick="deletePage({{ $page->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($pages->total() > $pages->perPage())
                                    {{ $pages->links() }}
                                @else
                                    Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} out of {{ $pages->total() }}
                                    results
                                @endif
                            @else
                                <div class="m-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
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
