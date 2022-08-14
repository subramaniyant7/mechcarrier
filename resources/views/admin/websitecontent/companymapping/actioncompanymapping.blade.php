@extends('admin.layout')
@section('title','Manage Company Mapping')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Company Mapping</li>
            </ol>
            <a href="{{ route('viewcompany') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{route('savecompanymapping')}}" method="POST" autocomplete="off" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Company Mapping<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="company_action" required>
                                    <option value="">Select</option>
                                    @foreach(companytype() as $k=> $company)
                                        <option value="{{$k+1}}" {{ isset($data) && $data[0]->company_action == $k+1 ? 'selected' : '' }}>{{$company}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="actionhtml" id="actionhtml">
                            @if($action == 'edit')
                                @if($data[0]->company_action == 1) @include('admin.websitecontent.companymapping.manualrender')
                                @elseif($data[0]->company_action == 2) @include('admin.websitecontent.companymapping.companyrender')
                                @endif
                            @endif
                        </div>

                        <div class="form-group row  mb-4 {{ $action == 'edit' ? '' : 'selected_show' }}">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Company Position<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control" name="company_position" placeholder="Position" required
                                       value="{{ isset($data) ? $data[0]->company_position : old('company_position') }}"
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

                        <div class="form-group row mb-4 {{ $action == 'edit' ? '' : 'selected_show' }}">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{route('viewcompany')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <input type="hidden" name="company_id" value="{{ isset($data) ? encryption($data[0]->company_id) : '' }}">
                        <input type="hidden" name="edit_image" value="{{ isset($data) && $action == 'edit' ? $data[0]->company_image : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


