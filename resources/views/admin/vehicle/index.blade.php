<x-dashboard-layout>
    <x-slot name="styles">
        @livewireStyles
    </x-slot>
    <x-slot name="title">
        Daala - Vehicle Listing
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Vehicle</a>
        </div>
    </x-slot>
    @livewire('vehicle-list')
    <x-slot name="scripts">
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function deleteVehicle(id) {
                swal({
                    title: "Are you sure?",
                    text: "You won't to delete this Vehicle",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('vehicleDeleted', id);
                            swal("Poof! Your Vehicle has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Your Vehicle has Been Save");
                        }
                    });
            }

            function updateStatusVehicle(id) {
                Livewire.emit('statusUpdated', id);
                swal({
                    icon: 'success',
                    text: 'Your Vehicle status has been updated!',
                    showConfirmButton: false,
                    timer: 1500
                })

            }

        </script>
    </x-slot>
</x-dashboard-layout>
