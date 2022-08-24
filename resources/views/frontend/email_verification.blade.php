@extends('frontend.layout')
@section('title', 'Email OTP Verification')
@section('content')
    <main>
        <div class="email-registration">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Welcome {{ $userInfo[0]->user_firstname }}</h4>

                        <h1>Thank you for registration</h1>
                        <h2>Please verify your email adreess : Enter OTP send to <span>{{ $userInfo[0]->user_email }}</span>
                        </h2>
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/home/mailicon.svg') }}" />
                        <form method="POST" action="{{ route('emailverificationsuccess') }}">
                            @csrf
                            <div class="d-flex">
                                <div class="email-registration-form">
                                    <input type="text" class="form-control" name="user_email_otp" required />
                                    <input type="hidden" class="form-control" name="user_identity"
                                        value="{{ encryption($userInfo[0]->user_id) }}" />
                                    <a href="#">Resend </a>

                                </div>
                            </div>
                            @if (session('error'))
                                <div class="error-message">
                                    <p>{{ session('error') }} </p>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">submit</button> <br />
                            <a href="#">Change Email ID</a>
                        </form>
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
