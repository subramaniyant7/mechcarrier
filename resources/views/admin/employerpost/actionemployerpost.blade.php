@extends('admin.layout')
@section('title', 'Manage Employer Post')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Employer Post</li>
            </ol>
            <a href="{{ route('viewemployerspost') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i
                    class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{ route('saveemployerpost') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Employer<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="employer_post_employee_id" required>
                                    <option value="">Select Employer</option>
                                    @foreach (getActiveRecord('employer_details') as $k => $employer_details)
                                        <option value="{{ $employer_details->employer_detail_id }}"
                                            {{ isset($data) && $data[0]->employer_post_employee_id == $employer_details->employer_detail_id ? 'selected' : '' }}>
                                            {{ $employer_details->employer_company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Headline<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="employer_post_headline"
                                    placeholder="Headline" required
                                    value="{{ isset($data) ? $data[0]->employer_post_headline : old('employer_post_headline') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Employment Type<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="employer_post_employement_type" required>
                                    <option value="">Select Employment Type</option>
                                    @foreach (employmentType() as $k => $employmentType)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_post_employement_type == $k + 1 ? 'selected' : '' }}>
                                            {{ $employmentType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Description
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="employer_post_description" required rows="5" minlength="10" maxlength="1000"
                                                placeholder="Describe activities in this job role " class="form-control">{{ isset($data) ? $data[0]->employer_post_description :'' }}</textarea>

                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Key Skils<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="employer_post_key_skils"
                                    placeholder="Key Skils" required
                                    value="{{ isset($data) ? $data[0]->employer_post_key_skils : old('employer_post_key_skils') }}">
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Employment Qualification<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="employer_post_qualification" required>
                                    <option value="">Select Employment Type</option>
                                    @foreach (education() as $k => $education)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_post_qualification == $k + 1 ? 'selected' : '' }}>
                                            {{ $education }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Hide Salary from Candidates<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="employer_post_hidesalary" required>
                                    <option value="">Select</option>
                                    @foreach (YesNo() as $k => $yesno)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_post_hidesalary == $k + 1 ? 'selected' : '' }}>
                                            {{ $yesno }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Salary Range<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-select" name="employer_post_salary_range_from_lakhs" required>
                                    <option value="">Select</option>
                                    @foreach (SalaryLakhs() as $k => $lakh)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_post_salary_range_from_lakhs == $k + 1 ? 'selected' : '' }}>
                                            {{ $lakh }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-select" name="employer_post_salary_range_from_thousands" required>
                                    <option value="">Select</option>
                                    @foreach (SalaryThousands() as $k => $thousand)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_post_salary_range_from_thousands == $k + 1 ? 'selected' : '' }}>
                                            {{ $thousand }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-select" name="employer_post_salary_range_to_lakhs" required>
                                    <option value="">Select</option>
                                    @foreach (SalaryLakhs() as $k => $lakh)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_post_salary_range_to_lakhs == $k + 1 ? 'selected' : '' }}>
                                            {{ $lakh }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-select" name="employer_post_salary_range_to_thousands" required>
                                    <option value="">Select</option>
                                    @foreach (SalaryThousands() as $k => $thousand)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_post_salary_range_to_thousands == $k + 1 ? 'selected' : '' }}>
                                            {{ $thousand }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Employment
                                Locations<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="employer_post_locations"
                                    placeholder="Employment Location" required
                                    value="{{ isset($data) ? $data[0]->employer_post_locations : old('employer_post_locations') }}">
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Employment Walk-in Details</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="employer_post_walkin_details"
                                    placeholder="Walk-in Details"
                                    value="{{ isset($data) ? $data[0]->employer_post_walkin_details : old('employer_post_walkin_details') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Save Status<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="employer_post_save_status" required>
                                    <option value="">Select Status</option>
                                    @foreach (SaveStatus() as $k => $saveStatus)
                                        <option value="{{ $k + 1 }}"
                                            {{ isset($data) && $data[0]->employer_post_save_status == $k + 1 ? 'selected' : '' }}>
                                            {{ $saveStatus }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if ($action == 'edit')

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
                                <a href="{{ route('viewemployerspost') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <input type="hidden" name="employer_post_id"
                            value="{{ isset($data) ? encryption($data[0]->employer_post_id) : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
