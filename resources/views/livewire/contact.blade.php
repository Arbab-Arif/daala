<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Contact Us
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
                            @if(count($contacts) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Email</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Contact No</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contacts as $key => $contact)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $contact->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $contact->email }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $contact->contact }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $contact->message }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($contacts->total() > $contacts->perPage())
                                    {{ $contacts->links() }}
                                @else
                                    Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} out
                                    of {{ $contacts->total() }}
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
