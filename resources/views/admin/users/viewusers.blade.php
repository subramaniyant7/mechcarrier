@extends('admin.layout')
@section('title', 'View Users')
@section('head')

    <head>
        <link href="{{ URL::asset(ADMIN . '/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset(ADMIN . '/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ URL::asset(ADMIN . '/plugins/css/dark/table/datatable/dt-global_style.css') }}" rel="stylesheet"
            type="text/css" />

    </head>
@stop

<style>
    .login::before {
        background-color: #009688;
    }
</style>
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
            <div>
                <a href="{{ route('importusers') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i
                        class="fa-solid fa-upload"></i> Import</a>
                <a href="{{ route('manageuser') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i
                        class="fa-solid fa-plus"></i> User</a>
            </div>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Email Verified</th>
                            <th>Mobile Verified</th>
                            <th>Registered From</th>
                            <th>Login Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $k => $user)
                            @php
                                $class = $user->status == 1 ? 'badge-light-success' : '';
                            @endphp
                            <tr>
                                <td> {{ $k + 1 }} </td>
                                <td> {{ $user->user_firstname }} </td>
                                <td> {{ $user->user_email }} </td>
                                <td> {{ $user->user_phonenumber }} </td>

                                <td>
                                    <span
                                        class="shadow-none badge {{ $user->user_email_verified != '' ? loginStatusClass()[$user->user_email_verified - 1] : '' }}">
                                        <i class="fa fa-{{ $user->user_email_verified == 1 ? 'check' : 'times' }}"
                                            aria-hidden="true"></i>
                                    </span>
                                </td>

                                <td>
                                    <span
                                        class="shadow-none badge {{ $user->user_phonenumber_verified != '' ? loginStatusClass()[$user->user_phonenumber_verified - 1] : '' }}">
                                        <i class="fa fa-{{ $user->user_phonenumber_verified == 1 ? 'check' : 'times' }}"
                                            aria-hidden="true"></i>
                                    </span>
                                </td>
                                <td> {{ registeredFrom()[$user->user_register_type - 1] }} </td>
                                <td>
                                    <span class="shadow-none badge {{ $user->user_logged_in != '' ? loginStatusClass()[$user->user_logged_in - 1] : '' }}">
                                        {{ loginStatus()[$user->user_logged_in - 1] }}
                                    </span>
                                </td>
                                <td> <span
                                        class="{{ statusClass()[$user->status - 1] }}">{{ statustype()[$user->status - 1] }}</span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="{{ route('actionuser', ['option' => 'edit', 'id' => encryption($user->user_id)]) }}"
                                            class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                            data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('actionuser', ['option' => 'delete', 'id' => encryption($user->user_id)]) }}"
                                            class="action-btn btn-delete bs-tooltip" data-toggle="tooltip"
                                            data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@section('footer')
    <script src="{{ URL::asset(ADMIN . '/plugins/src/table/datatable/datatables.js') }}"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
    </script>
@stop
