@extends('frontend.employer.layout')
@section('title', 'Job Post Success')
@section('content')
    <style>
        .close_icon {
            position: absolute;
            right: 18px;
            top: 10px;
            border: 1px solid;
            border-radius: 50%;
            padding: 0px 9px;
            font-size: 21px;
            cursor: pointer;
            z-index: 1;
        }
    </style>
    <main>
        <div class="email-registration email-success job-post-success">
            <div class="container bg-bluelight" style="position: relative">
                <div class="row">
                    <span class="close_icon">X</span>
                    <div class="col-md-12">

                        <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_success.svg') }}" />
                        <h1>Your Job was posted successfully</h1>
                        <h2> <span>Yon can share this post to get more candidates</span></h2>

                        <div style="margin-bottom: 20px">
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_share.svg') }}"
                                style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_linkedin.svg') }}"
                                style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_facebook.svg') }}"
                                style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_instagram.svg') }}"
                                style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_whatsapp.svg') }}"
                                style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_telegram.svg') }}" />
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </main>
@stop

