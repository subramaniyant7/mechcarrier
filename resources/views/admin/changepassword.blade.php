@extends('admin.layout')
@section('title','Change Password')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{route('updatepassword')}}" method="POST">
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Old Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-control" name="old_password" placeholder="Old Password" required
                                       value=""
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-control" name="new_password" placeholder="New Password" required
                                       value=""
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-control" name="confirm_password" placeholder="Confirm Password" required
                                       value=""
                                >
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-3 col-form-label col-form-label-lg"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        <span>Note : Once you changed the password it will logout automatically</span>
                        <input type="hidden" name="admin_id" value="{{ encryption(session('admin_id')) }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
