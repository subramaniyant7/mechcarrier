@extends('frontend.layout')
@section('title', 'Jobseeker Login')
@section('content')
    <main>
        <div class="login jobseeker-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1> India's 1st Job portal  for <span>Mechanical</span>  Fresher & Professionals  </h1>
                        <div class="user-image mt-70">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/jobseekerloginimage.svg')}}" />

                        </div>
                        <div class="help-assistance mt-70">
                            <p>For technical assitance please call to +91-8329556560</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-form bg-gray">
                            <div class="title">
                                <h1>Login</h1>
                                <p>If you don’t have an account register</p>
                                <p>You can <a href="{{ route('jobseekerregister') }}" >Register here !</a></p>
                            </div>
                            <div class="socialmedia-login">
                                <div class="d-flex">
                                    <div class="google-login">
                                        <a href="{{ url(FRONTENDURL.'login/google') }}"  class="socialmedia-login-button">
                                            <span><embed src="{{ URL::asset(FRONTEND.'/assets/images/googleicon.svg')}}" type="image/svg+xml" /> </span>   Login with Google
                                        </a>
                                    </div>
                                    <div class="linkedin-login">
                                        <a href="{{ url(FRONTENDURL.'login/linkedin') }}" class="socialmedia-login-button">
                                            <span><embed src="{{ URL::asset(FRONTEND.'/assets/images/linkedinicon.svg') }}" type="image/svg+xml" /> </span>   Login with LinkedIn
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">
                                <p>or</p>
                            </div>
                            <form autocomplete="off">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Email <span>*</span></label>
                                    <input type="email" id="form1Example1" placeholder="Enter your email address" class="form-control" />
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label" for="form1Example2">Password <span>*</span>
                                    </label>
                                    <input type="password" id="form1Example2" placeholder="Enter your password" class="form-control"
                                     autocomplete="new-password"/>
                                    <span> <img src="{{ URL::asset(FRONTEND.'/assets/images/passwordshowicon.svg')}}" /> </span>
                                </div>

                                <div class="row mb-4">
                                    <div class="col d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="form1Example3"
                                                   checked />
                                            <label class="form-check-label" for="form1Example3"> Remember me </label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <a href="#!">Forgot password?</a>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="error-msg">
                                            <span> Password or email not matched</span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </main>
@stop
