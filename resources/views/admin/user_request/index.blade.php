<x-dashboard-layout>
    <x-slot name="title">
        Daala - Booking Listing
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Job</a>
        </div>
    </x-slot>
    @livewire('user-request-list')
    <x-slot name="scripts">
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function deleteSubAdmin(id) {
                swal({
                    title: "Are you sure?",
                    text: "You won't to delete this admin",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('subAdminDeleted', id);
                            swal("Poof! Your Admin has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Your Admin has Been Save");
                        }
                    });
            }
        </script>
    </x-slot>
</x-dashboard-layout>
