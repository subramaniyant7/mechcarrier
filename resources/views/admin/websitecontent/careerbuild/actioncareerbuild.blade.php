@extends('admin.layout')
@section('title','Manage Career Build')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('analysisdashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Career Build</li>
            </ol>
            <a href="{{ route('viewcareerbuild') }}" class="btn btn-primary btn-rounded mb-2 me-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    @include('admin.notification')
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <form action="{{route('savecareerbuild')}}" method="POST" autocomplete="off" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Title<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="home_careerbuild_name" placeholder="Title" required
                                       value="{{ isset($data) ? $data[0]->home_careerbuild_name : old('home_careerbuild_name') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Description<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" name="home_careerbuild_description" placeholder="Description" required
                                       value="{{ isset($data) ? $data[0]->home_careerbuild_description : old('home_careerbuild_description') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"> Image <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control form-control" name="home_careerbuild_image" {{ isset($data) && $data[0]->home_careerbuild_image != '' ? '' : 'required' }}
                                       value="{{ isset($data) ? $data[0]->home_careerbuild_image : old('home_careerbuild_image') }}"
                                >
                                @if(isset($data) && $data[0]->home_careerbuild_image != '')
                                    <span><img style="width: 100%;height: 200px;margin-top: 1em;" src="{{ URL::asset('uploads/homecareerbuild/'.$data[0]->home_careerbuild_image)}}"></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">URL<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control form-control" name="home_careerbuild_url" placeholder="URL" required
                                       value="{{ isset($data) ? $data[0]->home_careerbuild_url : old('home_careerbuild_url') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Position<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control" name="home_careerbuild_position" placeholder="Position" required
                                       value="{{ isset($data) ? $data[0]->home_careerbuild_position : old('home_careerbuild_position') }}"
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
                                <a href="{{route('viewcareerbuild')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <input type="hidden" name="home_careerbuild_id" value="{{ isset($data) ? encryption($data[0]->home_careerbuild_id) : '' }}">
                        <input type="hidden" name="edit_image" value="{{ isset($data) ? $data[0]->home_careerbuild_image : ''  }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


