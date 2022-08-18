@extends('admin.layout')
@section('title','Home Page Content')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Home Page Banner</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{route('savebannnercontent')}}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Banner Title<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control" name="banner_title" placeholder="Title" required
                                       value="{{ count($bannerInfo) ? $bannerInfo[0]->banner_title : old('banner_title') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Banner Description<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control" name="banner_description" placeholder="Description" required
                                       value="{{ count($bannerInfo) ? $bannerInfo[0]->banner_description : old('banner_description') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Banner Image<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control form-control" name="banner_image" {{ isset($bannerInfo) && $bannerInfo[0]->banner_image != '' ? '' : 'required' }}
                                value="{{ isset($bannerInfo) ? $bannerInfo[0]->banner_image : old('banner_image') }}"
                                >
                                @if(isset($bannerInfo) && $bannerInfo[0]->banner_image != '')
                                    <span><img style="height: 200px;margin-top: 1em;" src="{{ URL::asset('uploads/homepage/'.$bannerInfo[0]->banner_image)}}"></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Company Logo<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control form-control" name="company_logo" {{ isset($bannerInfo) && $bannerInfo[0]->company_logo != '' ? '' : 'required' }}
                                value="{{ isset($bannerInfo) ? $bannerInfo[0]->company_logo : old('company_logo') }}"
                                >
                                @if(isset($bannerInfo) && $bannerInfo[0]->company_logo != '')
                                    <span><img style="height: 200px;margin-top: 1em;" src="{{ URL::asset('uploads/homepage/'.$bannerInfo[0]->company_logo)}}"></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Company Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control" name="company_name" placeholder="Company Name" required
                                       value="{{ count($bannerInfo) ? $bannerInfo[0]->company_name : old('company_name') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-3 col-form-label col-form-label-lg"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        <input type="hidden" name="banner_id" value="{{ count($bannerInfo) ? encryption($bannerInfo[0]->banner_id) : '' }}">
                        <input type="hidden" name="edit_bannerimage" value="{{ isset($bannerInfo) ? $bannerInfo[0]->banner_image : '' }}">
                        <input type="hidden" name="edit_companyimage" value="{{ isset($bannerInfo)  ? $bannerInfo[0]->company_logo : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
