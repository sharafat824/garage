@extends('layouts.app')

@section('content')
<style>
    @media screen and (max-width:540px) {
        div#service_info {
            margin-top: -177px;
        }

        span.titleup {
            margin-left: -10px;
        }
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" size="xl">
            <!-- Modal content-->
            <div class="modal-content modal_data p-2">
                <!-- Dynamic content for service details -->
            </div>
        </div>
    </div>

    <!-- Modal for Coupon Data -->
    <div class="modal fade" id="coupaon_data" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content used_coupn_modal_data">
            </div>
        </div>
    </div>
    <!-- End Modal for Coupon Data -->

    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <i class=""></i><span class="titleup">{{ trans('message.Other Services') }}
                            @can('service_add')
                            <a id="" href="{!! url('/other/service/add') !!}">
                                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}">
                            </a>
                            @endcan
                        </span>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
        @include('success_message.message')
        <div class="row">
            @if(!empty($services ) && count($services ) > 0)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel table_up_div">
                    <table id="supplier" class="table jambo_table" style="width:100%">
                        <thead>
                            <tr>
                                @can('service_delete')
                                <th> </th>
                                @endcan
                                <th>{{ trans('message.Name') }}</th>
                                <th>{{ trans('message.Short Description') }}</th>
                                <th>{{ trans('message.Cylinder') }}</th>
                                <th>{{ trans('message.Price') }}</th>
                                <th>{{ trans('message.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                            <tr data-service-id="{{ $service->id }}">
                                <td>
                                    <label class="container checkbox">
                                        <input type="checkbox" name="chk" value="{{ $service->id }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>

                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#myModal" serviceid="{{ $service->id }}"
                                        url="{{ url('/other/service/view') }}" class="save">
                                        {{ $service->name }}
                                    </a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Job No" class="text-primary">
                                        <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                                    </a>
                                </td>

                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#myModal" serviceid="{{ $service->id }}"
                                        url="{{ url('/other/service/view') }}" class="save">
                                        {{ $service->short_description }}
                                    </a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Job No" class="text-primary">
                                        <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#myModal" serviceid="{{ $service->id }}"
                                        url="{{ url('/other/service/view') }}" class="save">
                                        {{ $service->cylinder }}
                                    </a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Job No" class="text-primary">
                                        <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#myModal" serviceid="{{ $service->id }}"
                                        url="{{ url('/other/service/view') }}" class="save">
                                        {{ $service->price }}
                                    </a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Job No" class="text-primary">
                                        <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                                    </a>
                                </td>

                                <td>
                                    <div class="dropdown_toggle">
                                        <img src="{{ asset('public/img/list/dots.png') }}"
                                            class="btn dropdown-toggle border-0" type="button"
                                            id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                                        <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2"
                                            aria-labelledby="dropdownMenuButtonaction">
                                            @can('service_view')
                                            <li>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal"
                                                    serviceid="{{ $service->id }}" url="{{ url('/other/service/view') }}"
                                                    class="dropdown-item save border-0">
                                                    <img src="{{ asset('public/img/list/Vector.png') }}" class="me-3">
                                                    {{ trans('message.View') }}
                                                </button>
                                            </li>
                                            @endcan

                                            @can('service_edit')
                                            <li>
                                                <a class="dropdown-item" href="{{ url('/other/service/edit/' . $service->id) }}">
                                                    <img src="{{ asset('public/img/list/Edit.png') }}" class="me-3">
                                                    {{ trans('message.Edit') }}
                                                </a>
                                            </li>
                                            @endcan

                                            @can('service_delete')
                                            <div class="dropdown-divider m-0"></div>
                                            <li>
                                                <a class="dropdown-item sa-warning"
                                                    url="{{ url('/other/service/delete/' . $service->id) }}"
                                                    style="color:#FD726A">
                                                    <img src="{{ asset('public/img/list/Delete.png') }}" class="me-3">
                                                    {{ trans('message.Delete') }}
                                                </a>
                                            </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">{{ trans('message.No services found.') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @can('service_delete')
                    <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
                    <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/service/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    @endcan
                </div>
            </div>
            @else
            <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
            @endif
        </div>
    </div>
</div>


<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // SweetAlert2 confirmation on Delete
        $('.sa-warning').on('click', function(e) {
            var deleteUrl = $(this).attr('url');

            e.preventDefault();

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FD726A',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = deleteUrl;
                }
            });
        });

        // Load service details into modal dynamically
        $('.save').on('click', function() {
            var serviceId = $(this).attr('serviceid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                method: 'GET',
                data: { id: serviceId },
                success: function(response) {
                    $('.modal_data').html(response);
                }
            });
        });

        // Initialize DataTable
        var search = "{{ trans('message.Search...') }}";
        var info = "{{ trans('message.Showing page _PAGE_ - _PAGES_') }}";
        var zeroRecords = "{{ trans('message.No Data Found') }}";
        var infoEmpty = "{{ trans('message.No records available') }}";

        $('#supplier').DataTable({
            columnDefs: [{
                width: 2,
                targets: 0
            }],
            fixedColumns: true,
            paging: true,
            scrollCollapse: true,
            scrollX: true,
            responsive: true,
            "language": {
                lengthMenu: "_MENU_ ",
                info: info,
                zeroRecords: zeroRecords,
                infoEmpty: infoEmpty,
                infoFiltered: '(filtered from _MAX_ total records)',
                searchPlaceholder: search,
                search: '',
            },
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [-1]
            }],
            order: [
                [1, 'desc']
            ]
        });
    });
</script>
@endsection
