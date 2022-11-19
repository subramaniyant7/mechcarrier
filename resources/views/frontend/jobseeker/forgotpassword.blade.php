@extends('frontend.layout')
@section('title', 'Forgot Password')

@section('content')
    <main>
        <div class="email-registration number-verification forgot-password">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Forgot password ?</h1>
                        <p>Please enter Email ID to get new password</p>
                        <form action="{{ route('handlejobseekerforgotpassword') }}" method="POST">
                            @csrf
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/forgotpasswordmail.svg') }}" alt="mail" />
                            <div class="d-flex">
                                <div class="email-registration-form">
                                    <input type="email" name="user_email" class="form-control" placeholder="Enter Email ID" required />
                                    <button type="submit" class="btn btn-primary">submit</button>
                                </div>
                            </div>
                            @if (session('error'))
                            <div class="error-message">
                                <p>{{ session('error') }} </p>
                            </div>
                            @endif
                        </form>
                        <div class="number-d-flex">
                            <a href="#">Or Login using</a>
                        </div>
                        <div class="socialmedia-login">
                            <div class="d-flex">
                                <div class="google-login">
                                    <a href="{{ url(FRONTENDURL . 'login/google') }}" class="socialmedia-login-button">
                                        <span><embed src="{{ URL::asset(FRONTEND . '/assets/images/googleicon.svg') }}"
                                                type="image/svg+xml" /> </span> Login with Google
                                    </a>
                                </div>
                                <div class="linkedin-login">
                                    <a href="{{ url(FRONTENDURL . 'login/linkedin') }}" class="socialmedia-login-button">
                                        <span><embed src="{{ URL::asset(FRONTEND . '/assets/images/linkedinicon.svg') }}"
                                                type="image/svg+xml" /> </span> Login with LinkedIn
                                    </a>
                                </div>
                            </div>
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
