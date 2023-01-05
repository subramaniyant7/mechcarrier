@extends('admin.layout')
@section('title','Manage Jobseeker')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Jobseeker</li>
            </ol>
            <a href="{{ route('viewusers') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{route('saveuser')}}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">First Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="user_firstname" placeholder="First Name" required
                                       value="{{ isset($data) ? $data[0]->user_firstname : old('user_firstname') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Last Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="user_lastname" placeholder="Last Name" required
                                       value="{{ isset($data) ? $data[0]->user_lastname : old('user_lastname') }}"
                                >
                            </div>
                        </div>

                        @if($action == 'add')
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control" name="user_email" placeholder="Email" required
                                       value="{{ isset($data) ? $data[0]->user_email : old('user_email') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Password<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control form-control" name="user_password" placeholder="Password" required
                                       value="{{ isset($data) ? $data[0]->user_password : '' }}"
                                       autocomplete="new-password"
                                >
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Mobile Number<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control" name="user_phonenumber" placeholder="Mobile" required
                                       value="{{ isset($data) ? $data[0]->user_phonenumber : old('user_phonenumber') }}"
                                >
                            </div>
                        </div>

                        @endif

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Profile Picture</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control form-control" name="user_profile_picture"
                                       value="{{ isset($data) ? $data[0]->user_profile_picture : old('user_profile_picture') }}"
                                >
                            </div>
                        </div>

                        @if($action == 'edit')
                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Status<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="status" required>
                                    <option value="">Select Status</option>
                                    @foreach(statustype() as $k => $statusType)
                                        <option value="{{$k+1}}" {{ isset($data) && $data[0]->status == $k+1 ? 'selected' : '' }}>{{ $statusType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{route('viewusers')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ isset($data) ? encryption($data[0]->user_id) : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
