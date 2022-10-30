@extends('admin.layouts.app')
@section('header-links')

@endsection
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('all/admin/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('all/admin/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('all/admin/plugins/table/datatable/custom_dt_custom.css') }}">
    
    {{-- Modal Links --}}
    <link href="{{ asset('all/admin/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('all/admin/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('all/admin/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@section('contents')

@if(Auth::check() && Auth::user()->role_id == 1)
    <?php $url_group = 'superadmin' ?>
@elseif(Auth::check() && Auth::user()->role_id == 2)
    <?php $url_group = 'admin' ?>
@elseif(Auth::check() && Auth::user()->role_id == 3)
    <?php $url_group = 'staff' ?>
@endif

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="custom-heading-wrapper">
                            <h1 class="m-0 p-0 custom-heading">Students List</h1>
                            <div class="under-line-wrapper d-flex justify-content-around align-items-center">
                                <span class="left-line w-100"></span>
                                <span class="diamond"></span>
                                <span class="right-line w-100"></span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive my-4">
                        <table id="style-3" class="table style-3  table-hover">
                            <thead>
                                <tr>
                                    <th class="checkbox-column text-center"> SL </th>
                                    <th>Profile</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)    
                                    <tr>
                                        <td class="checkbox-column text-center"> {{ ++$loop->index }} </td>
                                        <td>
                                            <img  src="{{ $data->avatar ? asset('storage/'.$data->avatar) : asset('no-image.png') }}" width="80px" height="80px">
                                            <h6>{{ $data->name }}</h6>
                                        </td>
                                        <td>
                                            <b>Email: </b><span>{{ $data->email }}</span><br>
                                            <b>Phone: </b><span>{{ $data->phone }}</span><br>
                                            <b>Address: </b><span>{{ $data->address }}</span><br>
                                        </td>
                                        <td>
                                            @if ($data->status == 1)
                                                <Span class="text-success">Active</Span>
                                            @else
                                                <Span class="text-danger">Inactive</Span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route($url_group.'.students.details', $data->id) }}" target="_blank" rel="noopener noreferrer" title="Details"><i class="fas fa-info fa-2x"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
@endsection

@section('footer-links')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    {{-- Modal Links --}}
    <script src="{{ asset('all/admin/assets/js/scrollspyNav.js') }}"></script>   

    <script src="{{ asset('all/admin/plugins/table/datatable/datatables.js') }}"></script>
    <script>

        c3 = $('#style-3').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });

        multiCheck(c3);
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->  
@endsection