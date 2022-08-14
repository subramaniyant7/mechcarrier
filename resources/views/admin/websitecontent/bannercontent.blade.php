@extends('admin.layout')
@section('title','Home Page Content')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Banner Content</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{route('savebannnercontent')}}" method="POST">
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

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-3 col-form-label col-form-label-lg"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        <input type="hidden" name="banner_id" value="{{ count($bannerInfo) ? encryption($bannerInfo[0]->banner_id) : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
