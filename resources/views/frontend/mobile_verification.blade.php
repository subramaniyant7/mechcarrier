@extends('frontend.layout')
@section('title', 'Mobile OTP Verification')
@section('content')
    <main>
        <div class="email-registration number-verification">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Welcome {{ $userInfo[0]->user_firstname }}</h4>

                        <h1>Mobile number verification</h1>
                        <h2>Please verify your mobile number : Enter OTP send to
                            <span>{{ $userInfo[0]->user_phonenumber }}</span>
                        </h2>
                        <form method="POST" action="{{ route('mobileverificationsuccess') }}">
                            @csrf
                            <div class="d-flex">
                                <div class="email-registration-form">
                                    <input type="number" class="form-control" name="user_phone_otp" required />
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
                        </form>
                        <div class="number-d-flex">
                            <a href="#">Skip Now</a>
                            <a href="#">Change Mobile Number</a>
                        </div>
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
