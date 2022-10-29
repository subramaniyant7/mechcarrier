@extends('admin.layout')
@section('title', 'Manage University')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage University</li>
            </ol>
            <a href="{{ route('university') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i
                    class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{ route('saveuniversity') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Education Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="education_id" required>
                                    <option value="">Select Education</option>
                                    @foreach (getActiveRecord('education_info') as $k => $education)
                                        <option value="{{ $education->education_id }}"
                                            {{ isset($data) && $data[0]->education_id == $education->education_id ? 'selected' : '' }}>
                                            {{ $education->education_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">University Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="education_university_name" placeholder="Specialization Name"
                                    required value="{{ isset($data) ? $data[0]->education_university_name : old('education_university_name') }}">
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
                                <a href="{{ route('university') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <input type="hidden" name="education_university_id"
                            value="{{ isset($data) ? encryption($data[0]->education_university_id) : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
