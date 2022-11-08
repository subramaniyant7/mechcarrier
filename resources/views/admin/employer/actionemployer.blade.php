@extends('admin.layout')
@section('title', 'Manage Employer')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Employer</li>
            </ol>
            <a href="{{ route('viewemployers') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i
                    class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{ route('saveemployer') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Company Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="employer_company_name"
                                    placeholder="Company Name" required
                                    value="{{ isset($data) ? $data[0]->employer_company_name : old('employer_company_name') }}">
                            </div>
                        </div>
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Official
                                Email<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control" name="employer_email"
                                    placeholder="Official Email" required
                                    value="{{ isset($data) ? $data[0]->employer_email : old('employer_email') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Mobile Number<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control" name="employer_mobile"
                                    placeholder="Mobile Number" required
                                    value="{{ isset($data) ? $data[0]->employer_mobile : old('employer_mobile') }}">
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Contact
                                Person<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="employer_contact_person"
                                    placeholder="Contact Person" required
                                    value="{{ isset($data) ? $data[0]->employer_contact_person : old('employer_contact_person') }}">
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">CIN / GST</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="employer_gst"
                                    placeholder="CIN / GST"
                                    value="{{ isset($data) ? $data[0]->employer_gst : old('employer_gst') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Company Type<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="employer_company_type" required>
                                    <option value="">Select Company Type</option>
                                    @foreach (typeOfCompany() as $k => $companytype)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_company_type == $k + 1 ? 'selected' : '' }}>
                                            {{ $companytype }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if ($action == 'edit')

                            <div class="form-group row mb-4">
                                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Employer Verify Status<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="employer_verified" required>
                                        <option value="">Select Verifitied Status</option>
                                        @foreach (verifiedStatus() as $k => $verifiedstatus)
                                            <option value="{{ $k + 1 }}"
                                                {{ isset($data) && $data[0]->employer_verified == $k + 1 ? 'selected' : '' }}>
                                                {{ $verifiedstatus }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Status<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="status" required>
                                        <option value="">Select Status</option>
                                        @foreach (statustype() as $k => $statusType)
                                            <option value="{{ $k + 1 }}"
                                                {{ isset($data) && $data[0]->status == $k + 1 ? 'selected' : '' }}>
                                                {{ $statusType }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('viewemployers') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <input type="hidden" name="employer_detail_id"
                            value="{{ isset($data) ? encryption($data[0]->employer_detail_id) : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
