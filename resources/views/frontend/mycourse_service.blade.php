@extends('frontend.layout')


@section('content')

<main>
    <div class="mycourses-services">
        <div class="bg-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>My Skill improvement course and services</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="button-d-flex">
                            <div class="breadcrumb-button">
                                <button type="button"> 15 </button>
                                <p>My referal points</p>
                            </div>
                            <div class="breadcrumb-button">
                                <button type="button"> 10 </button>
                                <p>validation pending points</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="enhance-your-resume">
        <div class="container">
            <div class="row">
                <div class="col-md-12 home-page">
                    <div class="title">
                        <h1>My enrolled courses and services</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg') }}" />
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Resume Building</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er2.svg') }}" />
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Career Booster</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg') }}" />
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Resume Building</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er2.svg') }}" />
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Personal guide</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="enhance-your-resume bg-offwhite">
        <div class="container">
            <div class="row">
                <div class="col-md-12 home-page">
                    <div class="title">
                        <h1>All courses and services</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg') }}" />
                            <span class="image-tag"> 5 point </span>
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Resume Building</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er2.svg') }}" />
                            <span class="image-tag"> 5 point </span>
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Career Booster</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg') }}" />
                            <span class="image-tag"> 5 point </span>
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Resume Building</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er2.svg') }}" />
                            <span class="image-tag"> 5 point </span>
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Personal guide</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg') }}" />
                            <span class="image-tag"> 5 point </span>
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Resume Building</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er2.svg') }}" />
                            <span class="image-tag"> 5 point </span>
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Career Booster</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg') }}" />
                            <span class="image-tag"> 5 point </span>
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Resume Building</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="enhance-your-resume-card">
                        <div class="enhance-your-resume-image">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er2.svg') }}" />
                            <span class="image-tag"> 5 point </span>
                        </div>
                        <div class="enhance-your-resume-card-title">
                            <h4>Personal guide</h4>
                            <p>Grab the attention of employers by building best grab the attention ...</p>
                            <a href="#" target="_blank">Read More<span><img
                                        src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@stop
