@extends('admin.layout')
@section('title','Manage Why We')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Why We</li>
            </ol>
            <a href="{{ route('viewwhywe') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{route('savewhywe')}}" method="POST" autocomplete="off" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="whywe_name" placeholder="Name" required
                                       value="{{ isset($data) ? $data[0]->whywe_name : old('whywe_name') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Image<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control form-control" name="whywe_image" {{ isset($data) && $data[0]->whywe_image != '' ? '' : 'required' }}
                                value="{{ isset($data) ? $data[0]->whywe_image : old('whywe_image') }}"
                                >
                                @if(isset($data) && $data[0]->whywe_image != '')
                                    <span><img style="width: 100%;height: 200px;margin-top: 1em;" src="{{ URL::asset('uploads/whywe/'.$data[0]->whywe_image)}}"></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Company Position<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control" name="whywe_position" placeholder="Position" required
                                       value="{{ isset($data) ? $data[0]->whywe_position : old('whywe_position') }}"
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
                                <a href="{{route('viewwhywe')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <input type="hidden" name="whywe_id" value="{{ isset($data) ? encryption($data[0]->whywe_id) : '' }}">
                        <input type="hidden" name="edit_image" value="{{ isset($data) && $action == 'edit' ? $data[0]->whywe_image : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


