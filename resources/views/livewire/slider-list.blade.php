<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Slider List
        </h2>
        <h2 class="text-right font-medium">
            <a href="{{ route('admin.slider.create') }}">
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
                            @if(count($sliders) > 0)
                                <button class="button bg-theme-1 text-white mt-5 m-2 delete_all"
                                        data-url="{{ route('admin.slider.delete.all') }}">Delete All Selected
                                </button>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                            <input type="checkbox" id="selectBox" class="mr-2">Select All
                                        </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Image</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sliders as $key => $slider)
                                        <tr id="tr_{{$slider->id}}">
                                            <td class="border-b"><input type="checkbox" class="sub_chk" data-id="{{$slider->id}}"></td>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                <img class="h-10 zoom-in" src="{{ $slider->getImagePath('image') }}">

                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                <a href="{{ route('admin.slider.edit', $slider->id) }}">
                                                    <button type="submit" class="button bg-blue-600 text-white">Edit
                                                    </button>
                                                </a>
                                                <button type="button" onclick="deleteSlider({{ $slider->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($sliders->total() > $sliders->perPage())
                                    {{ $sliders->links() }}
                                @else
                                    Showing {{ $sliders->firstItem() }} to {{ $sliders->lastItem() }} out of {{ $sliders->total() }}
                                    results
                                @endif
                            @else
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
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
