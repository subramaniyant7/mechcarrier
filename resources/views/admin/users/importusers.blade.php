@extends('admin.layout')
@section('title', 'Import Users')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Import User</li>
            </ol>
            <a href="{{ route('viewusers') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i
                    class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{ route('saveimportusers') }}" method="POST" autocomplete="off" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">File (CSV)<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control form-control" name="user_import"
                                    placeholder="First Name" required>
                            </div>
                            <div class="col-sm-4">
                                <a style="display:block;margin-top:1em;color:#4361ee"
                                    href="{{ route('downloadsamplefile') }}"><i class="fa-solid fa-download"></i> Sample
                                    Format</a>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <a href="{{ route('viewusers') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
