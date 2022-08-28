@extends('frontend.layout')
@section('title', 'My Course Video')
@section('content')
    <main>
        <div class="mycourse-videopage">
            <div class="video-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/coursevideo.svg')}}" />
                        </div>
                        <div class="col-md-8">
                            <h1>Resume Building</h1>
                            <p>Grab the attention of employers by building best grab the
                                attention Grab the attention of employers by building best
                                grab the attention Grab the attention of employers by building
                                best grab the attention Grab the attention of employers by
                                building best grab the attention ......</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Video 1 : Introduction</h3>
                            <iframe height="417" src="https://www.youtube.com/embed/rx508dWvr8M"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            <h3>Video 2 : Basic concept</h3>
                            <iframe height="417" src="https://www.youtube.com/embed/iOy_Aae8k1E"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="col-md-4">
                            <div class="video-recommended">
                                <h3>Recommended </h3>
                                <div class="enhance-your-resume-card">
                                    <div class="enhance-your-resume-image">
                                        <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg') }}">
                                        <span class="image-tag"> 5 point </span>
                                    </div>
                                    <div class="enhance-your-resume-card-title">
                                        <h4>Resume Building</h4>
                                        <p>Grab the attention of employers by building best grab the attention ...</p>
                                        <button type="button" class="btn btn-primary">Enroll</button>
                                    </div>
                                </div>
                                <div class="enhance-your-resume-card">
                                    <div class="enhance-your-resume-image">
                                        <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg') }}">
                                        <span class="image-tag"> 5 point </span>
                                    </div>
                                    <div class="enhance-your-resume-card-title">
                                        <h4>Resume Building</h4>
                                        <p>Grab the attention of employers by building best grab the attention ...</p>
                                        <button type="button" class="btn btn-primary">Enroll</button>
                                    </div>
                                </div>
                                <div class="view-btn">
                                    <button type="button" class="btn btn-primary view-all">View all</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
