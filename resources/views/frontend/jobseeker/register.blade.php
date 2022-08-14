@extends('frontend.layout')
@section('title', 'Jobseeker Register')
@section('content')
    <main>
        <div class="login jobseeker-register jobseeker-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Let’s get Started, <br/> tell us about yourself </h1>
                        <div class="help-assistance">
                            <p>It only takes a couples of minutes to get started</p>
                        </div>

                        <div class="user-image">
                            <embed src="{{ URL::asset(FRONTEND.'/assets/images/registerimage.svg')}}" type="image/svg+xml" />
                        </div>

                        <div class="key-points">
                            <ul>
                                <li>One click apply using MechCareer profile</li>
                                <li>Get relevant job recommendations</li>
                                <li>Showcase profile to top comapnies and consultabts</li>
                                <li>Know application status on applied jobs</li>
                            </ul>
                        </div>
                        <div class="help-assistance mt-20">
                            <p>For technical assitance please call to +91-8329556560</p>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="login-form bg-gray">
                            <div class="title">
                                <p>If you already have an account register</p>
                                <p>You can <a href="{{route('jobseekerlogin')}}" >Login here !</a></p>
                            </div>
                            <div class="socialmedia-login">
                                <div class="d-flex">
                                    <div class="google-login">
                                        <a href="{{ url(FRONTENDURL.'login/google') }}" class="socialmedia-login-button">
                                            <span><embed src="{{ URL::asset(FRONTEND.'/assets/images/googleicon.svg') }}" type="image/svg+xml" /> </span>   Register with Google
                                        </a>
                                    </div>
                                    <div class="linkedin-login">
                                        <a href="{{ url(FRONTENDURL.'login/linkedin    ') }}" class="socialmedia-login-button">
                                            <span><embed src="{{ URL::asset(FRONTEND.'/assets/images/linkedinicon.svg')}}" type="image/svg+xml" /> </span>   Register with LinkedIn
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">
                                <p>or</p>
                            </div>
                            <form autocomplete="off">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">User Name<span>*</span></label>
                                    <div class="d-flex">
                                        <input type="text" id="form1Example1" placeholder="First Name" class="form-control" />
                                        <input type="text" id="form1Example1" placeholder="Last Name" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Email <span>*</span></label>
                                    <input type="email" id="form1Example1" placeholder="Enter your email address" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Mobile Number <span>*</span></label>
                                    <input type="number" id="form1Example1" placeholder="Enter yourMobile Number" class="form-control" />
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label" for="form1Example2">Password <span>*</span>
                                    </label>
                                    <input type="password" id="form1Example2" placeholder="Enter your password" class="form-control"
                                           autocomplete="new-password"/>
                                    <span> <img src="{{ URL::asset(FRONTEND.'/assets/images/passwordshowicon.svg')}}" /> </span>
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label" for="form1Example2">ConfirmPassword <span>*</span>
                                    </label>
                                    <input type="password" id="form1Example2" placeholder="RE-Enter your password" class="form-control" />
                                    <span> <img src="{{ URL::asset(FRONTEND.'/assets/images/passwordshowicon.svg')}}" /> </span>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="error-msg">
                                            <span> Error : Passward not match</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="termsandconditions">
                                            <span> Terms and Conditions</span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </main>
@stop
