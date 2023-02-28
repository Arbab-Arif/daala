<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Item List
        </h2>
        <h2 class="text-right font-medium">
            <h2 class="font-medium text-lg">
                <input type="file" name="excelImportFile" wire:model="excelImportFile">
            </h2>
            <div class="intro-y flex space-x-64 items-center mt-8">
                @error('excelImportFile')
                <div role="alert" class="mt-3 w-full">
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p>{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </div>
            <button type="submit" wire:click="save()" wire:loading.attr="disabled"
                    class="button bg-theme-1 text-white mt-5 m-2">
                <svg wire:loading.class.remove="hidden" wire:target="save"
                     class="animate-spin hidden -ml-1 mr-3 h-5 w-5 text-white"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span>Import</span>
            </button>
            <button type="submit" wire:click="itemExport()" class="button bg-theme-1 text-white mt-5 m-2">Export
            </button>
            <button type="submit" wire:click="sampleDownload()" class="button bg-theme-1 text-white mt-5 m-2">Sample
                File
            </button>
            <a href="{{ route('admin.item.create') }}">
                <button type="submit" class="button bg-theme-1 text-white mt-5 m-2">Create</button>
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
                            @if(count($items) > 0)
                                <button class="button bg-theme-1 text-white mt-5 m-2 delete_all"
                                        data-url="{{ route('admin.item.delete.all') }}">Delete All Selected
                                </button>
                                <table class="table scrollable">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                            <input type="checkbox" id="selectBox" class="mr-2">Select All
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">S.No #</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Category Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Unit</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Item Description</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $key => $item)
                                        <tr id="tr_{{$item->id}}">
                                            <td class="border-b"><input type="checkbox" class="sub_chk" data-id="{{$item->id}}"></td>
                                            <td class="border-b">{{ $key +1 }}</td>
                                            <td class="border-b">{{ $item->name }}</td>
                                            <td class="border-b">{{ optional($item->category)->name ?? 'N/A' }}</td>
                                            <td class="border-b">{{ $item->unit }}</td>
                                            <td class="border-b">{{ $item->description }}</td>
                                            <td class="border-b">
                                                <a href="{{ route('admin.item.edit', $item->id) }}">
                                                    <button type="submit"
                                                            class="button bg-blue-600 text-white">
                                                        Edit
                                                    </button>
                                                </a>
                                                <button type="button"
                                                        onclick="deleteItem({{ $item->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($items->total() > $items->perPage())
                                    {{ $items->links() }}
                                @else
                                    Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} out of {{ $items->total() }}
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
