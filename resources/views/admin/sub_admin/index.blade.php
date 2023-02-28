<x-dashboard-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot name="title">
        Daala - Sub Admin Listing
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">User</a>
        </div>
    </x-slot>
    @livewire('sub-admin')
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
                        }
                    });
            }

            $(document).ready(function () {
                $('#selectBox').on('click', function (e) {
                    if ($(this).is(':checked', true)) {
                        $(".sub_chk").prop('checked', true);
                    } else {
                        $(".sub_chk").prop('checked', false);
                    }
                });

                $('.delete_all').on('click', function (e) {
                    var allVals = [];
                    $(".sub_chk:checked").each(function () {
                        allVals.push($(this).attr('data-id'));
                    });
                    if (allVals.length <= 0) {
                        swal({
                            text: "Please Select Al Least One Check Box",
                            icon: "warning",
                            dangerMode: true,
                        });
                    } else {
                        swal({
                            title: "Are you sure?",
                            text: "You won't to delete Selected User",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                            .then((willDelete) => {
                                if (willDelete) {
                                    var join_selected_values = allVals.join(",");
                                    $.ajax({
                                        url: $(this).data('url'),
                                        type: 'DELETE',
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                        data: 'ids=' + join_selected_values,
                                        success: function (data) {
                                            if (data) {
                                                $(".sub_chk:checked").each(function () {
                                                    $(this).parents("tr").remove();
                                                });

                                            } else if (data['error']) {
                                                swal({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'Something went wrong!',
                                                });
                                            } else {
                                                swal({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'Something went wrong!',
                                                });
                                            }
                                        },
                                        error: function (data) {
                                            alert(data.responseText);
                                        }
                                    });
                                    $.each(allVals, function (index, value) {
                                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                                    });
                                }
                            });
                    }
                });
            });
        </script>
    </x-slot>
</x-dashboard-layout>
