@extends('frontend.employer.layout')
@section('title', 'Job Post Success')
@section('content')
    <main>
        <div class="email-registration email-success">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_success.svg') }}" />
                        <h1>Your Job was posted successfully</h1>
                        <h2> <span>Yon can share this post to get more candidates</span></h2>

                        <div style="margin-bottom: 20px">
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_share.svg') }}" style="padding-right:10px;"/>
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_linkedin.svg') }}" style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_facebook.svg') }}" style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_instagram.svg') }}" style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_whatsapp.svg') }}" style="padding-right:10px;" />
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost_telegram.svg') }}" />
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </main>
@stop
