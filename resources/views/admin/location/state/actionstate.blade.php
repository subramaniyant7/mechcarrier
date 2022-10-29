@extends('admin.layout')
@section('title', 'Manage State')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage State</li>
            </ol>
            <a href="{{ route('state') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i
                    class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{ route('savestate') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Country Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="country_id" required>
                                    <option value="">Select Country</option>
                                    @foreach (getActiveRecord('country') as $k => $country)
                                        <option value="{{ $country->country_id }}"
                                            {{ isset($data) && $data[0]->country_id == $country->country_id ? 'selected' : '' }}>
                                            {{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">State Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="state_name" placeholder="State Name"
                                    required value="{{ isset($data) ? $data[0]->state_name : old('state_name') }}">
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
                                <a href="{{ route('state') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <input type="hidden" name="state_id"
                            value="{{ isset($data) ? encryption($data[0]->state_id) : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
