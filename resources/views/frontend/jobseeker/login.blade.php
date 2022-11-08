@extends('frontend.layout')
@section('title', 'Jobseeker Login')
<style>
    .forgot {
        padding: 0 !important;
    }
</style>
@section('content')

    <main>
        <div class="login jobseeker-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1> India's 1st Job portal for <span>Mechanical</span> Fresher & Professionals </h1>
                        <div class="user-image mt-70">
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/jobseekerloginimage.svg') }}" />
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
                                <p>You can <a href="{{ route('jobseekerregister') }}">Register here !</a></p>
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
                            <div class="form-text">
                                <p>or</p>
                            </div>
                            <form autocomplete="off" method="POST" action="{{ route('jobseekervalidate') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <label class="form-label">Email <span>*</span></label>
                                    <input type="email" name="user_email" placeholder="Enter your email address" class="form-control" required />
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label">Password <span>*</span></label>
                                    <input type="password" name="user_password" placeholder="Enter your password" class="form-control view"
                                        autocomplete="new-password" required />
                                    <span><img onclick="viewText(this)" src="{{ URL::asset(FRONTEND . '/assets/images/passwordshowicon.svg') }}" style="cursor:pointer" /></span>
                                </div>

                                <div class="form-outline mb-4" style="display: flex">
                                    <div class="col d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" />
                                            <label class="form-check-label" for="form1Example3"> Remember me </label>
                                        </div>
                                    </div>

                                    <div class="col forgot">
                                        <a href="#!">Forgot password?</a>
                                    </div>
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
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
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
