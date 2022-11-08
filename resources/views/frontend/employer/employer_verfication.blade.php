@extends('frontend.layout')
@section('title', 'Recruiter Verification')
@section('content')

    <main>
        <div class="email-registration email-success">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/employerverify.svg') }}">
                        <h1>Recruiter verification under process</h1>
                        <h2> <span> Please wait, our technical team will verify company details</span></h2>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="technical-assistance">
                            <p>For technical assitance please call to +91-8329556560</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
