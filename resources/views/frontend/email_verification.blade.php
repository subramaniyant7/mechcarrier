@extends('frontend.layout')
@section('title','Email Registration')
@section('content')
    <main>
        <div class="email-registration">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Welcome {{ $userInfo[0]->user_firstname }}</h4>

                        <h1>Thank you for registration</h1>
                        <h2>Please verify your email adreess : Enter OTP send to <span>{{ $userInfo[0]->user_email }}</span></h2>
                        <img src="{{ URL::asset(FRONTEND.'/assets/images/home/mailicon.svg')}}" />
                        <div class="d-flex">
                            <div class="email-registration-form">
                                <form method="POST" action="{{route('verifyemailotp')}}">
                                    <input type="text" class="form-control" name="user_email_otp"/>
                                    <input type="hidden" class="form-control" name="user_identity" value="{{ encryption($userInfo[0]->user_id) }}"/>
                                    <a href="#">Resend </a>
                                </form>
                            </div>
                        </div>
                        <div class="error-message">
                            <p>Verification fail, please try again </p>
                        </div>
                        <button type="submit" class="btn btn-primary">submit</button> <br/>
                        <a href="#">Change Email ID</a>
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
