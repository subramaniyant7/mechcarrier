@extends('admin.layout')
@section('title','Social Media Links')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Social Media</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    <div class="row">
         <div class="col-lg-12 col-12  layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Social Media Links</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('savesocialmedia')}}" method="POST">
                        @csrf
                        <div class="form-group row  mb-4">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Facebook</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control form-control-sm" name="social_media_facebook" placeholder="Facebook" required
                                       value="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_facebook : old('social_media_facebook') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">LinkedIn</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control form-control-sm" name="social_media_linkedin" placeholder="LinkedIn" required
                                    value="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_linkedin : old('social_media_linkedin') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control form-control-sm" name="social_media_instagram" placeholder="Instagram" required
                                       value="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_instagram : old('social_media_instagram') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Twitter</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control form-control-sm" name="social_media_twitter" placeholder="Twitter" required
                                       value="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_twitter : old('social_media_twitter') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">YouTube</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control form-control-sm" name="social_media_youtube" placeholder="YouTube" required
                                       value="{{ count($socialMediaLink) ? $socialMediaLink[0]->social_media_youtube : old('social_media_youtube') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        <input name="social_media_id" value="{{ count($socialMediaLink) ? encryption($socialMediaLink[0]->social_media_id) : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
