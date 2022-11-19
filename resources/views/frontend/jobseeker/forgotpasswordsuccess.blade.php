@extends('frontend.layout')
@section('title', 'Forgot Password Success')
@section('content')

    <main>
        <div class="email-registration email-success">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/home/verificationmailicon.svg') }}" />
                        <h1>New Password sent succefully</h1>
                        <h2> <span>Please check your email and login</span></h2>
                        <br /><br />
                        <a style="color:#fff" href="{{ route('jobseekerlogin') }}" class="btn btn-primary">Login</a> <br />
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
