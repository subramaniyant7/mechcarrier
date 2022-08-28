@extends('frontend.layout')
@section('title', 'Jobseeker Register')
@section('content')
    <main>
        <div class="login jobseeker-register jobseeker-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Let’s get Started, <br /> tell us about yourself </h1>
                        <div class="help-assistance">
                            <p>It only takes a couples of minutes to get started</p>
                        </div>

                        <div class="user-image">
                            <embed src="{{ URL::asset(FRONTEND . '/assets/images/registerimage.svg') }}"
                                type="image/svg+xml" />
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
                                <p>You can <a href="{{ route('jobseekerlogin') }}">Login here !</a></p>
                            </div>
                            <div class="socialmedia-login">
                                <div class="d-flex">
                                    <div class="google-login">
                                        <a href="{{ url(FRONTENDURL.'login/google') }}" class="socialmedia-login-button">
                                            <span><embed src="{{ URL::asset(FRONTEND.'/assets/images/googleicon.svg') }}"
                                                    type="image/svg+xml" /> </span> Register with Google
                                        </a>
                                    </div>
                                    <div class="linkedin-login">
                                        <a href="{{ url(FRONTENDURL.'login/linkedin') }}" class="socialmedia-login-button">
                                            <span><embed     src="{{ URL::asset(FRONTEND.'/assets/images/linkedinicon.svg') }}"
                                                    type="image/svg+xml" /> </span> Register with LinkedIn
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">
                                <p>or</p>
                            </div>
                            <form autocomplete="off" method="POST" action="{{ route('jobseekerregistration') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">User Name<span>*</span></label>
                                    <div class="d-flex">
                                        <input type="text" placeholder="First Name" class="form-control"
                                            name="user_firstname" required />
                                        <input type="text" placeholder="Last Name" class="form-control"
                                            name="user_lastname" required />
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Email <span>*</span></label>
                                    <input type="email" placeholder="Enter your email address" name="user_email"
                                        class="form-control " required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Mobile Number <span>*</span></label>
                                    <input type="number" minlength="10" maxlength="10" placeholder="Enter yourMobile Number" name="user_phonenumber"
                                        class="form-control" required />
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label" for="form1Example2">Password <span>*</span>
                                    </label>
                                    <input type="password" placeholder="Enter your password" name="user_password"
                                        class="form-control view" autocomplete="new-password" required />
                                    <span> <img onclick="viewText(this)"
                                            src="{{ URL::asset(FRONTEND . '/assets/images/passwordshowicon.svg') }}"  style="cursor:pointer"/>
                                    </span>
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label" for="form1Example2">ConfirmPassword <span>*</span>
                                    </label>
                                    <input type="password" placeholder="Re-Enter your password" name="user_confirmpassword"
                                        class="form-control view" required />
                                    <span> <img onclick="viewText(this)" src="{{ URL::asset(FRONTEND . '/assets/images/passwordshowicon.svg') }}"  style="cursor:pointer"/>
                                    </span>
                                </div>

                                @if (session('error'))
                                <div class="form-outline mb-4">
                                    <div class="col">
                                        <div class="error-msg">
                                            <span> Error : {{ session('error') }}</span>
                                        </div>
                                    </div>
                                </div>

                                @endif

                                <div class="form-outline">
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


<script>
    function viewText(val) {
        let element = $(val).parent().parent().find(".view");
        if (element.attr('type') === "password") {
            element.attr('type', "text");
        } else {
            element.attr('type', "password");
        }
    }
</script>
